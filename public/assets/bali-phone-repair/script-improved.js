const supportedAnalyticsEvents = new Set([
  'whatsapp_click',
  'phone_call_click',
  'directions_click',
  'contact_form_start',
  'contact_form_submit',
  'service_view',
  'location_view',
  'article_view',
  'article_cta_click',
  'related_service_click',
  'related_article_click',
  'location_whatsapp_click',
  'location_call_click',
  'location_direction_click',
  'location_service_click',
]);

const analyticsParameterAllowlist = new Set([
  'page_type',
  'content_id',
  'cta_location',
  'form_id',
  'submission_status',
  'outlet_label',
  'service_id',
  'service_slug',
  'service_name',
  'location_id',
  'location_slug',
  'location_type',
  'article_id',
  'article_slug',
  'category_slug',
  'author_id',
  'cta_type',
  'source_type',
  'source_id',
  'target_service_id',
  'target_article_id',
  'link_position',
]);

const analyticsPageContext = () => {
  const { pageType, contentId } = document.body?.dataset || {};

  return {
    page_type: pageType || 'unknown',
    ...(contentId ? { content_id: contentId } : {}),
  };
};

const trackAnalyticsEvent = (eventName, parameters = {}) => {
  try {
    if (!supportedAnalyticsEvents.has(eventName)) return;

    const safeParameters = {};
    Object.entries(parameters).forEach(([key, value]) => {
      if (
        analyticsParameterAllowlist.has(key)
        && ['string', 'number', 'boolean'].includes(typeof value)
        && String(value).length <= 100
      ) {
        safeParameters[key] = value;
      }
    });

    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event: eventName, ...safeParameters });
  } catch {
    // Analytics must never interrupt the visitor's action.
  }
};

window.BaliPhoneRepairAnalytics = Object.freeze({ track: trackAnalyticsEvent });

document.addEventListener('click', (event) => {
  const link = event.target.closest('a[href]');
  if (!link) return;

  const href = link.getAttribute('href') || '';
  const declaredEvent = link.dataset.analyticsEvent;
  const context = {
    ...analyticsPageContext(),
    cta_location: link.dataset.analyticsLocation || 'unspecified',
  };

  if (declaredEvent && supportedAnalyticsEvents.has(declaredEvent)) {
    const parameters = {};
    Object.entries(link.dataset).forEach(([key, value]) => {
      if (!key.startsWith('analytics') || ['analyticsEvent', 'analyticsLocation'].includes(key)) return;
      const parameterName = key.slice('analytics'.length).replace(/[A-Z]/g, (letter) => `_${letter.toLowerCase()}`);
      parameters[parameterName] = value;
    });
    trackAnalyticsEvent(declaredEvent, { ...context, ...parameters });
  } else if (/^https:\/\/wa\.me\//i.test(href)) {
    trackAnalyticsEvent('whatsapp_click', context);
  } else if (/^tel:/i.test(href)) {
    trackAnalyticsEvent('phone_call_click', context);
  } else if (/^https:\/\/(?:www\.google\.com\/maps|maps\.app\.goo\.gl)/i.test(href)) {
    trackAnalyticsEvent('directions_click', {
      ...context,
      outlet_label: link.querySelector('strong')?.textContent.trim() || 'unspecified',
    });
  }
});

const startedAnalyticsForms = new WeakSet();
document.addEventListener('focusin', (event) => {
  const form = event.target.closest('form[data-analytics-form]');
  if (!form || startedAnalyticsForms.has(form)) return;

  startedAnalyticsForms.add(form);
  trackAnalyticsEvent('contact_form_start', {
    ...analyticsPageContext(),
    form_id: form.dataset.analyticsForm,
  });
});

document.addEventListener('analytics:contact-form-submit', (event) => {
  trackAnalyticsEvent('contact_form_submit', {
    ...analyticsPageContext(),
    form_id: event.detail?.formId || 'contact',
    submission_status: 'success',
  });
});

const pageViewEvent = {
  service: 'service_view',
  location: 'location_view',
  article: 'article_view',
}[document.body?.dataset.pageType];

if (pageViewEvent) {
  const viewParameters = {};
  Object.entries(document.body?.dataset || {}).forEach(([key, value]) => {
    if (!key.startsWith('analytics')) return;
    const parameterName = key.slice('analytics'.length).replace(/[A-Z]/g, (letter) => `_${letter.toLowerCase()}`);
    viewParameters[parameterName] = value;
  });
  trackAnalyticsEvent(pageViewEvent, { ...analyticsPageContext(), ...viewParameters });
}

const menuToggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('.nav');
if (menuToggle && nav) {
  menuToggle.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', String(open));
  });
}

document.querySelectorAll('.filter-tabs button').forEach((button) => {
  button.addEventListener('click', () => {
    const filter = button.dataset.filter;
    document.querySelectorAll('.filter-tabs button').forEach((item) => item.classList.remove('active'));
    button.classList.add('active');
    document.querySelectorAll('.service-card').forEach((card) => {
      const categories = card.dataset.category || '';
      card.classList.toggle('hidden', filter !== 'all' && !categories.includes(filter));
    });
  });
});

document.querySelectorAll('.hero-tech-carousel, .hero-assistant-carousel, .hero-support-carousel, .rental-card-carousel').forEach((carousel) => {
  const slides = Array.from(carousel.querySelectorAll('img'));
  if (slides.length < 2) return;

  const interval = Number(carousel.dataset.carouselInterval) || 5000;
  let activeIndex = slides.findIndex((slide) => slide.classList.contains('active'));
  if (activeIndex < 0) activeIndex = 0;
  slides[activeIndex].classList.add('active');

  window.setInterval(() => {
    slides[activeIndex].classList.remove('active');
    activeIndex = (activeIndex + 1) % slides.length;
    slides[activeIndex].classList.add('active');
  }, interval);
});
