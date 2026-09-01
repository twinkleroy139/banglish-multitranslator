# 🌐 Banglish Multi-Translator

<div align="center">

**⚡ Banglish Multi-Translator — Universal Banglish & Multilingual Translation Engine**

[![Live Demo](https://img.shields.io/badge/Live-Demo-brightgreen?style=for-the-badge\&logo=render)](https://banglish-multitranslator.onrender.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue?style=for-the-badge\&logo=php)](https://www.php.net/)
[![Python](https://img.shields.io/badge/Python-3.10%2B-yellow?style=for-the-badge\&logo=python)](https://www.python.org/)
[![FastAPI](https://img.shields.io/badge/FastAPI-Backend-009688?style=for-the-badge\&logo=fastapi)](https://fastapi.tiangolo.com/)
[![Docker](https://img.shields.io/badge/Docker-Containerized-2496ED?style=for-the-badge\&logo=docker)](https://www.docker.com/)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

**A full-stack real-time translation platform that converts phonetic Banglish into proper Bengali script and translates it into multiple target languages through a modern, responsive interface.**

[**🚀 Explore Live Application**](https://banglish-multitranslator.onrender.com) · [**🐛 Report Bug / Request Feature**](https://github.com/twinkleroy139/banglish-multitranslator/issues)


Live Web URL: https://banglish-multitranslator.onrender.com/

</div>

---

## 💡 About The Project

**Banglish Multi-Translator** is a full-stack, real-time translation application designed to bridge the gap between **Banglish (Bengali written using Roman/English characters)** and standard Bengali script while also supporting translation into multiple target languages.

The application provides a familiar **Google Translate-style interface** with dynamic Light/Dark themes, instant translation, phonetic processing, custom dictionary support, and a Python-powered translation backend.

For example:

```text
Input:
kemon acho tmi

Bangla:
কেমন আছো তুমি

English:
How are you?
```

The system combines a **PHP frontend**, **Python FastAPI translation engine**, custom vocabulary mappings, and external translation services into a single containerized application.

---

## ✨ Key Features & Capabilities

* **🔤 Phonetic Banglish Processing**
  Converts Romanized Bengali such as `kemon acho tmi` into natural Bengali script such as `কেমন আছো তুমি`.

* **🌍 Universal Translation Engine**
  Supports multilingual translation through the Python FastAPI backend and external translation services.

* **📖 Custom Dictionary Overrides**
  Uses localized dictionary mappings to improve recognition of Banglish vocabulary, slang, and contextual expressions.

* **🎨 Modern Dual-Theme Interface**
  Responsive Google Translate-inspired interface with smooth **Light / Dark mode** switching.

* **⚡ Instant Auto-Debounce**
  Dynamically processes text while typing while reducing unnecessary backend requests.

* **📱 Responsive User Experience**
  Designed to work smoothly across desktop and mobile screen sizes.

* **🔄 PHP → FastAPI Integration**
  The PHP frontend communicates with the Python translation engine through an internal API proxy.

* **🐳 Single-Container Architecture**
  Apache/PHP and the FastAPI/Uvicorn backend run together inside a Docker container for simplified deployment.

* **☁️ Render Deployment Ready**
  Includes Docker configuration for deploying the complete application as a Render Web Service.

---

## 🛠️ Technology Stack

| Layer                 | Technologies                                       |
| --------------------- | -------------------------------------------------- |
| **Frontend**          | PHP 8.2, HTML5, CSS3, JavaScript                   |
| **UI**                | CSS Variables, Responsive Layout, Light/Dark Theme |
| **API Communication** | JavaScript Fetch API, PHP cURL                     |
| **Backend**           | Python 3.10+, FastAPI, Uvicorn                     |
| **Translation**       | `deep-translator`, Google Phonetic Engine          |
| **Dictionary**        | JSON-based Custom Dictionary                       |
| **Web Server**        | Apache                                             |
| **Containerization**  | Docker                                             |
| **Deployment**        | Render Web Services                                |

---

## 🏗️ System Architecture

```text
┌──────────────────────────────────────────────────────────────┐
│                       Docker Container                       │
│                                                              │
│  ┌────────────────────────┐        cURL        ┌────────────┐ │
│  │   Apache / PHP         │ ─────────────────> │  FastAPI   │ │
│  │   Frontend             │                    │  Backend   │ │
│  │                        │                    │            │ │
│  │   index.php            │                    │  app.py    │ │
│  │   api_proxy.php        │                    │  Port 8000 │ │
│  └────────────────────────┘                    └────────────┘ │
│            │                                      │           │
│            │                                      ▼           │
│            │                              ┌──────────────┐   │
│            │                              │ Translation  │   │
│            │                              │   Engine     │   │
│            │                              └──────────────┘   │
│            │                                      │           │
│            ▼                                      ▼           │
│       User Interface                    Custom Dictionary    │
│                                        + External Services   │
└──────────────────────────────────────────────────────────────┘
```

### Translation Flow

```text
User Input
    │
    ▼
Banglish Text
    │
    ▼
PHP Frontend
    │
    ▼
PHP API Proxy
    │
    ▼
FastAPI Translation Engine
    │
    ├── Custom Dictionary
    │
    ├── Banglish → Bangla Processing
    │
    └── Multilingual Translation
    │
    ▼
Structured JSON Response
    │
    ▼
PHP / JavaScript UI
    │
    ▼
Translated Result
```

---

## 📁 Repository Structure

```text
banglish-multitranslator/
├── backend_python/
│   ├── app.py
│   │   # FastAPI translation engine & API endpoints
│   │
│   ├── dictionary.json
│   │   # Custom localized definitions
│   │
│   └── requirements.txt
│       # Python dependencies
│
├── public/
│   ├── assets/
│   │   └── css/
│   │       └── style.css
│   │           # UI stylesheet & theme variables
│   │
│   ├── api_proxy.php
│   │   # PHP → FastAPI internal API proxy
│   │
│   └── index.php
│       # Main Google Translate-style interface
│
├── Dockerfile
│   # Apache + Python container configuration
│
├── vercel.json
│   # Optional Vercel deployment configuration
│
├── LICENSE
│
└── README.md
```

---

## ⚙️ Getting Started Locally

Follow these steps to run **Banglish Multi-Translator** on your local development machine.

### Prerequisites

* **PHP 8.2+**
* **Python 3.10+**
* **Git**
* **pip**
* **Apache / XAMPP** *(optional)*

### 1. Clone the Repository

```bash
git clone https://github.com/twinkleroy139/banglish-multitranslator.git
cd banglish-multitranslator
```

### 2. Set Up the Python Backend

Navigate to the Python backend:

```bash
cd backend_python
```

Install the required dependencies:

```bash
pip install -r requirements.txt
```

Start the FastAPI server:

```bash
python -m uvicorn app:app --host 127.0.0.1 --port 8000 --reload
```

The FastAPI backend will now be available at:

```text
http://127.0.0.1:8000
```

### 3. Start the PHP Frontend

Open a **second terminal** and return to the project root:

```bash
cd banglish-multitranslator
```

Start the PHP development server on a different port:

```bash
php -S localhost:8080 -t public
```

The frontend will be available at:

```text
http://localhost:8080
```

> **Note:** FastAPI uses port `8000`, while the PHP frontend uses port `8080` to prevent a port conflict.

### 4. Open the Application

Open your browser and visit:

```text
http://localhost:8080
```

You should now be able to enter Banglish text and receive Bengali and multilingual translations through the FastAPI backend.

---

## 🐳 Docker Deployment

Banglish Multi-Translator includes a custom **Dockerfile** that allows the PHP/Apache frontend and Python/FastAPI backend to operate within a single container.

### Deploying to Render

1. Push the project to your GitHub repository.

2. Open the [Render Dashboard](https://dashboard.render.com/).

3. Select:

```text
New + → Web Service
```

4. Connect the repository:

```text
twinkleroy139/banglish-multitranslator
```

5. Set the environment to:

```text
Docker
```

6. Leave the Build Command and Start Command empty if your `Dockerfile` already defines the required startup process.

7. Click:

```text
Create Web Service
```

8. Wait for the Docker image to build and the service to deploy.

Once deployment is complete, Render will provide your live application URL.

### 🌐 Live Application

**https://banglish-multitranslator.onrender.com**

---

## 📖 API Usage

### `GET /translate`

The translation backend exposes a `/translate` endpoint for processing text.

### Request

```http
GET /translate?text=kemon%20acho%20tmi&from_lang=auto&to_lang=en
```

### Example Response

```json
{
  "match_found": true,
  "source": "google_phonetic_engine",
  "result": {
    "translation": "how are you",
    "bangla": "কেমন আছো তুমি"
  }
}
```

### Response Fields

| Field         | Description                                                |
| ------------- | ---------------------------------------------------------- |
| `match_found` | Indicates whether a matching Banglish conversion was found |
| `source`      | Identifies the source/engine used for the conversion       |
| `translation` | Translation in the requested target language               |
| `bangla`      | Converted Bengali-script representation                    |

---

## 🔄 Example Translation Workflow

### Banglish → Bangla

```text
Input:
ami valo achi

Output:
আমি ভালো আছি
```

### Banglish → Bangla → English

```text
Input:
kemon acho tmi

Bangla:
কেমন আছো তুমি

English:
How are you?
```

The system can use the Bengali conversion as part of the multilingual translation workflow while also applying custom dictionary mappings when available.

---

## 🔐 Security & Configuration

For production deployments:

* Do not expose sensitive credentials or private configuration files.
* Keep environment-specific configuration outside publicly accessible files.
* Validate and sanitize user-provided input before processing.
* Restrict backend services to the required network interfaces.
* Keep dependencies updated.
* Avoid committing secrets, credentials, or API keys to GitHub.

---

## ☁️ Live Demo

Experience the application online:

**🚀 [Banglish Multi-Translator — Live Application](https://banglish-multitranslator.onrender.com)**

---

## 📄 License

This project is distributed under the **MIT License**.

See the [`LICENSE`](LICENSE) file for more information.

---

## 👤 Author

**Twinkle Roy**

Built as a full-stack engineering project combining **PHP, Python, FastAPI, real-time translation, custom language processing, and Docker-based deployment**.

⭐ If you find this project useful, consider giving the repository a star on [GitHub](https://github.com/twinkleroy139).
