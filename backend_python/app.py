import json
import os
import re
import requests
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from deep_translator import GoogleTranslator

app = FastAPI()

# Enable CORS for external frontend calls
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

DICT_PATH = os.path.join(os.path.dirname(__file__), "dictionary.json")
dictionary = {}

if os.path.exists(DICT_PATH):
    with open(DICT_PATH, "r", encoding="utf-8") as f:
        dictionary = json.load(f)

BANGLISH_NORMALIZATION = {
    "tmke": "tomake",
    "tmi": "tumi",
    "ami": "ami",
    "kc": "kichu",
    "kno": "keno",
    "nh": "na",
    "nah": "na",
    "tw": "to"
}

def transliterate_word(word: str) -> str:
    clean_word = BANGLISH_NORMALIZATION.get(word.lower(), word)
    try:
        url = f"https://inputtools.google.com/request?text={clean_word}&itc=bn-t-i0-und&num=1"
        res = requests.get(url, timeout=3).json()
        if res[0] == "SUCCESS" and res[1][0][1]:
            return res[1][0][1][0]
    except Exception:
        pass
    return word

def banglish_to_bangla_sentence(text: str) -> str:
    tokens = re.findall(r"[\w']+|[^\w\s]", text)
    converted_tokens = []

    for token in tokens:
        if re.match(r"^\w+$", token):
            converted_tokens.append(transliterate_word(token))
        else:
            converted_tokens.append(token)

    sentence = ""
    for token in converted_tokens:
        if re.match(r"^[^\w\s]$", token):
            sentence = sentence.rstrip() + token + " "
        else:
            sentence += token + " "

    return sentence.strip()

@app.get("/")
def home():
    return {
        "status": "online",
        "message": "Banglish Translation Engine API is running successfully!",
        "endpoint": "/translate?text=ami&from_lang=auto&to_lang=en"
    }

@app.get("/translate")
def translate(text: str, from_lang: str = "auto", to_lang: str = "en"):
    text_clean = text.strip()
    if not text_clean:
        return {"match_found": False, "message": "Empty query"}

    # Custom Dictionary Check
    if from_lang in ["auto", "banglish"] and text_clean.lower() in dictionary:
        return {
            "match_found": True,
            "source": "custom_dictionary",
            "result": dictionary[text_clean.lower()]
        }

    try:
        # Handle Banglish or Auto phonetic pipeline
        if from_lang in ["auto", "banglish"]:
            bangla_text = banglish_to_bangla_sentence(text_clean)
            translated_text = GoogleTranslator(source='bn', target=to_lang).translate(bangla_text)
            
            return {
                "match_found": True,
                "source": "google_phonetic_engine",
                "result": {
                    "translation": translated_text,
                    "bangla": bangla_text
                }
            }

        # Standard Direct Translation
        translated_text = GoogleTranslator(source=from_lang, target=to_lang).translate(text_clean)
        return {
            "match_found": True,
            "source": "google_translator",
            "result": {
                "translation": translated_text,
                "bangla": None
            }
        }

    except Exception as e:
        return {
            "match_found": False,
            "source": "error",
            "message": str(e)
        }