<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 2301: Service Suspended</title>
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
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
            border-radius: 12px;
            max-width: 520px;
            width: 100%;
            padding: 40px 32px;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 8px 10px -6px rgba(0, 0, 0, 0.5);
        }
        .status-pill {
            display: inline-block;
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 9999px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 24px;
            font-weight: 700;
            line-height: 1.3;
            color: #ffffff;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }
        p {
            font-size: 15px;
            line-height: 1.6;
            color: #94a3b8;
            margin-bottom: 24px;
        }
        .divider {
            height: 1px;
            background: #1f2937;
            margin: 24px auto;
            width: 100%;
        }
        .meta {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 12px;
            color: #64748b;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="status-pill">CRITICAL SYSTEM STATUS</div>
        <h1>Error 2301: Service Suspended</h1>
        <p>System configuration check failed. Please contact the administrator.</p>
        <div class="divider"></div>
        <div class="meta">REF: SYS-BPR-SEC-2301 &bull; TIMESTAMP: {{ gmdate('Y-m-d\TH:i:s\Z') }}</div>
    </div>
</body>
</html>

