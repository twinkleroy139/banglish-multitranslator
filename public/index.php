<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universal Multi-Language Translator</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="app-wrapper">
        <header class="header">
            <div class="logo-area">
                <span class="logo-icon">🌐</span>
                <h1>Banglish Multi-Translator</h1>
            </div>
            <button class="theme-toggle-btn" id="themeToggleBtn">🌙 Dark Mode</button>
        </header>

        <main class="translator-card">
            <div class="lang-tabs">
                <select id="fromLang">
                    <option value="auto" selected>Banglish / Auto Detect</option>
                    <option value="en">English</option>
                    <option value="bn">Bangla</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                    <option value="ar">Arabic</option>
                    <option value="hi">Hindi</option>
                    <option value="ja">Japanese</option>
                </select>

                <button class="swap-btn" id="swapBtn" title="Swap Languages">⇄</button>

                <select id="toLang">
                    <option value="en" selected>English</option>
                    <option value="bn">Bangla</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                    <option value="ar">Arabic</option>
                    <option value="hi">Hindi</option>
                    <option value="ja">Japanese</option>
                </select>
            </div>

            <div class="panels-container">
                <div class="panel panel-left">
                    <textarea id="inputText" placeholder="Type text or Banglish here..."></textarea>
                </div>
                <div class="panel panel-right">
                    <div class="output-text" id="outputText">Translation will appear here...</div>
                    <span class="meta-tag" id="engineTag">Source: Idle</span>
                </div>
            </div>
        </main>
    </div>

    <script>
        let typingTimer;
        const inputText = document.getElementById('inputText');
        const outputText = document.getElementById('outputText');
        const engineTag = document.getElementById('engineTag');
        const fromLang = document.getElementById('fromLang');
        const toLang = document.getElementById('toLang');
        const swapBtn = document.getElementById('swapBtn');
        const themeToggleBtn = document.getElementById('themeToggleBtn');

        // Dark / Light Theme Toggle Logic
        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            themeToggleBtn.innerText = newTheme === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode';
        });

        function triggerTranslation() {
            clearTimeout(typingTimer);
            if (!inputText.value.trim()) {
                outputText.innerText = 'Translation will appear here...';
                engineTag.innerText = 'Source: Idle';
                return;
            }
            typingTimer = setTimeout(translateText, 300);
        }

        inputText.addEventListener('input', triggerTranslation);
        fromLang.addEventListener('change', triggerTranslation);
        toLang.addEventListener('change', triggerTranslation);

        swapBtn.addEventListener('click', () => {
            if (fromLang.value === 'auto') return;
            const temp = fromLang.value;
            fromLang.value = toLang.value;
            toLang.value = temp;
            triggerTranslation();
        });

        function translateText() {
            const query = encodeURIComponent(inputText.value.trim());
            const src = fromLang.value;
            const tgt = toLang.value;

            fetch(`api_proxy.php?text=${query}&from=${src}&to=${tgt}`)
                .then(res => res.json())
                .then(data => {
                    if (data.match_found) {
                        let content = `<strong>Translation:</strong> ${data.result.translation}`;
                        if (data.result.bangla) {
                            content += `<br><br><strong>Phonetic Bangla:</strong> ${data.result.bangla}`;
                        }
                        outputText.innerHTML = content;
                        engineTag.innerText = `Source: ${data.source}`;
                    } else {
                        outputText.innerText = 'No translation found.';
                        engineTag.innerText = 'Source: None';
                    }
                })
                .catch(() => {
                    outputText.innerText = 'Error connecting to backend.';
                    engineTag.innerText = 'Source: Connection Error';
                });
        }
    </script>
</body>
</html>