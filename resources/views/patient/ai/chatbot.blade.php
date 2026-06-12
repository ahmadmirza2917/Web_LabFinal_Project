@extends('layouts.dashboard')
@section('title', 'AI Health Chatbot')

@section('content')
<div class="content-card" style="max-width:750px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-robot me-2" style="color:#00d4aa"></i>AI Health Assistant</h5>
        <span class="badge" style="background:#f0fff9;color:#00d4aa">Powered by Gemini AI</span>
    </div>

    <!-- Chat Window -->
    <div id="chatWindow" style="height:430px;overflow-y:auto;padding:15px;background:#f8f9fa;border-radius:14px;margin-bottom:20px">
        <div class="chat-msg bot mb-3">
            <div style="display:flex;gap:10px;align-items:flex-start">
                <div style="width:36px;height:36px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0">
                    <i class="fas fa-robot" style="font-size:0.9rem"></i>
                </div>
                <div style="background:#fff;border-radius:0 14px 14px 14px;padding:12px 16px;max-width:80%;box-shadow:0 2px 8px rgba(0,0,0,0.06)">
                    Hello! I'm your AI Health Assistant. I can answer health questions, guide you through the system, and provide general medical information. How can I help you today?
                </div>
            </div>
        </div>
    </div>

    <!-- Input -->
    <div class="d-flex gap-3">
        <input type="text" id="chatInput" class="form-control" placeholder="Ask a health question..."
            onkeypress="if(event.key==='Enter')sendMsg()">
        <button onclick="sendMsg()" class="btn btn-success px-4" id="sendBtn" style="border-radius:12px;flex-shrink:0">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>

    <!-- Quick Questions -->
    <div class="mt-3">
        <p class="text-muted mb-2" style="font-size:0.85rem">Quick questions:</p>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['What causes fever?','How to improve immunity?','Signs of diabetes?','When to see a doctor?'] as $q)
            <span class="badge rounded-pill px-3 py-2" style="background:#e3f2fd;color:#0f4c75;cursor:pointer"
                onclick="document.getElementById('chatInput').value='{{ $q }}';sendMsg()">{{ $q }}</span>
            @endforeach
        </div>
    </div>

    <p class="mt-3 text-muted" style="font-size:0.78rem">
        <i class="fas fa-info-circle me-1"></i>AI responses are informational only. Consult a doctor for medical decisions.
    </p>
</div>
@endsection

@push('scripts')
<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

async function sendMsg() {
    const input = document.getElementById('chatInput');
    const msg = input.value.trim();
    if(!msg) return;

    appendMsg(msg, 'user');
    input.value = '';
    input.disabled = true;
    document.getElementById('sendBtn').disabled = true;
    appendTyping();

    try {
        const res = await fetch('{{ route("patient.ai.chat") }}', {
            method: 'POST',
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},
            body: JSON.stringify({message: msg})
        });
        const data = await res.json();
        removeTyping();
        appendMsg(data.response || 'Sorry, I could not process that.', 'bot');
    } catch(e) {
        removeTyping();
        appendMsg('Sorry, there was an error. Please try again.', 'bot');
    }

    input.disabled = false;
    document.getElementById('sendBtn').disabled = false;
    input.focus();
}

function appendMsg(text, type) {
    const win = document.getElementById('chatWindow');
    const isBot = type === 'bot';
    const div = document.createElement('div');
    div.className = 'mb-3';
    div.style.display = 'flex';
    div.style.justifyContent = isBot ? 'flex-start' : 'flex-end';
    div.innerHTML = isBot ? `
        <div style="display:flex;gap:10px;align-items:flex-start;max-width:85%">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0">
                <i class="fas fa-robot" style="font-size:0.9rem"></i>
            </div>
            <div style="background:#fff;border-radius:0 14px 14px 14px;padding:12px 16px;box-shadow:0 2px 8px rgba(0,0,0,0.06);white-space:pre-wrap">${escHtml(text)}</div>
        </div>` : `
        <div style="background:linear-gradient(135deg,#0f4c75,#00d4aa);color:#fff;border-radius:14px 0 14px 14px;padding:12px 16px;max-width:75%">${escHtml(text)}</div>`;
    win.appendChild(div);
    win.scrollTop = win.scrollHeight;
}

function appendTyping() {
    const win = document.getElementById('chatWindow');
    const div = document.createElement('div');
    div.id = 'typing';
    div.className = 'mb-3';
    div.innerHTML = `<div style="display:flex;gap:10px;align-items:center">
        <div style="width:36px;height:36px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0">
            <i class="fas fa-robot" style="font-size:0.9rem"></i>
        </div>
        <div style="background:#fff;border-radius:0 14px 14px 14px;padding:12px 16px;box-shadow:0 2px 8px rgba(0,0,0,0.06)">
            <span class="spinner-border spinner-border-sm text-secondary"></span> Thinking...
        </div>
    </div>`;
    win.appendChild(div);
    win.scrollTop = win.scrollHeight;
}

function removeTyping() {
    const t = document.getElementById('typing');
    if(t) t.remove();
}

function escHtml(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
}
</script>
@endpush