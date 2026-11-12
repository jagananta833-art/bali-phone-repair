<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System License Renewal &mdash; Bali Phone Repair</title>
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #0b0f19;
            color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 14px;
            max-width: 580px;
            width: 100%;
            padding: 36px 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
        }
        .header {
            text-align: center;
            margin-bottom: 28px;
        }
        .badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 9999px;
            margin-bottom: 12px;
        }
        h1 {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
        }
        .desc {
            font-size: 14px;
            color: #94a3b8;
            line-height: 1.5;
        }
        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #fca5a5;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.35);
            color: #86efac;
        }
        .status-box {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 14px 16px;
            font-size: 13px;
            margin-bottom: 24px;
        }
        .status-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }
        .status-row:last-child {
            margin-bottom: 0;
        }
        .status-label {
            color: #94a3b8;
        }
        .status-val {
            font-weight: 600;
            color: #f1f5f9;
        }
        .status-val.active {
            color: #4ade80;
        }
        .status-val.expired {
            color: #f87171;
        }
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
        }
        textarea {
            width: 100%;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #f8fafc;
            padding: 12px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 12px;
            line-height: 1.4;
            min-height: 110px;
            resize: vertical;
            margin-bottom: 20px;
        }
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        button {
            width: 100%;
            background: #2563eb;
            color: #ffffff;
            border: none;
            padding: 13px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s ease;
        }
        button:hover {
            background: #1d4ed8;
        }
        .footer-note {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <div class="badge">SECURITY GATEWAY</div>
            <h1>System License Renewal</h1>
            <p class="desc">Enter a cryptographically signed authorization token to restore or extend system operations.</p>
        </div>

        @if (session('error'))
            <div class="alert alert-error">
                <strong>Activation Failed:</strong> {{ session('error') }}
            </div>
        @endif

        @if (session('ok'))
            <div class="alert alert-success">
                <strong>Success:</strong> {{ session('ok') }}
            </div>
        @endif

        <div class="status-box">
            <div class="status-row">
                <span class="status-label">Current State:</span>
                <span class="status-val {{ $status['valid'] ? 'active' : 'expired' }}">
                    {{ $status['valid'] ? 'ACTIVE' : 'SUSPENDED (' . $status['reason'] . ')' }}
                </span>
            </div>
            @if ($status['expires_at'])
            <div class="status-row">
                <span class="status-label">Expiry Date:</span>
                <span class="status-val">{{ $status['expires_at']->format('d M Y, H:i') }} UTC</span>
            </div>
            <div class="status-row">
                <span class="status-label">Remaining:</span>
                <span class="status-val">{{ $status['days_left'] }} day(s)</span>
            </div>
            @endif
        </div>

        <form action="{{ route('license.renew.submit') }}" method="POST">
            @csrf
            <label for="license_token">Cryptographic License Key (BPR1...)</label>
            <textarea id="license_token" name="license_token" required placeholder="Paste your authorization token here..."></textarea>
            <button type="submit">Verify &amp; Activate License</button>
        </form>

        <div class="footer-note">
            Authorized administrator maintenance &bull; bali-phone-repair
        </div>
    </div>
</body>
</html>

