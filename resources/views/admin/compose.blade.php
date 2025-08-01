@include('admin.mail_sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Email Composer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  <style>
    /* Base styles */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f1f3f4;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    header {
      display: flex;
      align-items: center;
      padding: 8px 16px;
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      font-family: Arial, sans-serif;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    header button {
      background: none;
      border: none;
      cursor: pointer;
      padding: 8px;
      flex-shrink: 0;
    }
    header img {
      height: 24px;
      margin: 0 24px 0 8px;
      flex-shrink: 0;
    }
    .search-container {
      flex-grow: 1;
      max-width: 720px;
      position: relative;
    }
    .search-container input[type="search"] {
      width: 100%;
      padding: 8px 40px 8px 16px;
      border: 1px solid #dadce0;
      border-radius: 8px;
      font-size: 14px;
      color: #202124;
      outline-offset: 2px;
    }
    .search-container svg {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
    }

    /* Email Composer Wrapper */
    .email-wrapper {
      padding: 30px 16px 80px; /* extra bottom padding for drag space */
      min-height: calc(100vh - 56px);
      box-sizing: border-box;
      position: relative;
    }

    /* Email container */
    .email-container {
      width: 700px;
      max-width: 100%;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      padding: 20px;
      position: absolute;
      left: 100px;
      top: 150px;
      cursor: move;
      box-sizing: border-box;
      user-select: none;
      margin-left: 20%;
      max-height: 80vh;
      overflow: auto;
    }

    .header {
      font-weight: bold;
      font-size: 14px;
      margin-bottom: 10px;
      user-select: text;
    }

    .field {
      margin-bottom: 10px;
    }
    .field input {
      width: 100%;
      border: none;
      border-bottom: 1px solid #ccc;
      padding: 6px;
      font-size: 14px;
      outline-offset: 2px;
      outline-color: #1a73e8;
      user-select: text;
    }

    .editor {
      min-height: 200px;
      border: none;
      font-size: 14px;
      padding: 6px;
      outline: 1px solid #ccc;
      border-radius: 4px;
      overflow-y: auto;
      user-select: text;
    }

    .toolbar {
      display: flex;
      flex-wrap: wrap;
      border-top: 1px solid #ccc;
      padding-top: 10px;
      margin-top: 10px;
      user-select: none;
    }
    .toolbar button, .toolbar select {
      background: none;
      border: none;
      margin: 0 5px 5px 0;
      font-size: 16px;
      cursor: pointer;
      user-select: none;
      padding: 4px 6px;
      border-radius: 3px;
      transition: background-color 0.2s ease;
    }
    .toolbar button:hover, .toolbar select:hover {
      background-color: #e8f0fe;
    }

    .send-bar {
      display: flex;
      align-items: center;
      margin-top: 10px;
      flex-wrap: wrap;
      user-select: none;
    }
    .send-bar button {
      background-color: #1a73e8;
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
      margin-right: 8px;
      margin-bottom: 8px;
      flex-shrink: 0;
      user-select: none;
    }
    .send-bar .icon-btn {
      background: none;
      border: none;
      margin-left: 0;
      margin-right: 8px;
      font-size: 18px;
      cursor: pointer;
      padding: 6px;
      user-select: none;
      border-radius: 4px;
      transition: background-color 0.2s ease;
    }
    .send-bar .icon-btn:hover {
      background-color: #e8f0fe;
    }

    /* Attachment list */
    #attachmentList {
      margin-top: 8px;
      font-size: 13px;
      color: #555;
      user-select: text;
    }
    #attachmentList span {
      display: inline-block;
      margin-right: 10px;
      background: #f1f3f4;
      padding: 3px 6px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    .trash-icon {
      position: absolute;
      bottom: 20px;
      right: 20px;
      font-size: 18px;
      color: gray;
      cursor: pointer;
      user-select: none;
      transition: color 0.2s ease;
    }
    .trash-icon:hover {
      color: #d93025;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .email-wrapper {
        padding: 16px;
      }
      .email-container {
        position: fixed !important;
        left: 50% !important;
        top: 70px !important;
        transform: translateX(-50%);
        width: 95% !important;
        max-width: 700px !important;
        max-height: calc(100vh - 140px);
        overflow-y: auto;
        cursor: default !important; /* Disable drag cursor */
        user-select: text;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      }
      .trash-icon {
        position: fixed !important;
        bottom: 90px !important;
        right: 30px !important;
      }
    }

    @media (max-width: 480px) {
      header img {
        margin-right: 12px;
      }
      .send-bar button {
        flex-grow: 1;
        margin-bottom: 8px;
      }
    }
  </style>
</head>
<body>

  <!-- Your sidebar included via blade -->
  {{-- @include('admin.mail_sidebar') --}}

  <!-- Gmail Style Header -->
  <header>
    <button aria-label="Menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5f6368" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg>
    </button>
    <img src="https://ssl.gstatic.com/ui/v1/icons/mail/rfr/logo_gmail_lockup_default_1x_r2.png" alt="Gmail" />
    <div class="search-container">
      <input type="search" placeholder="Search mail" aria-label="Search mail" />
      <svg width="20" height="20" fill="#5f6368" viewBox="0 0 24 24">
        <path d="M15.5 14h-.79l-.28-.27a6.471 6.471 0 001.48-5.34C15.03 6.01 12.52 3.5 9.5 3.5S4 6.01 4 9.5 6.52 15.5 9.5 15.5c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
      </svg>
    </div>
    <button aria-label="Clear search" style="display: none;">
      <svg width="20" height="20" fill="#5f6368" viewBox="0 0 24 24">
        <path d="M18 6L6 18M6 6l12 12" stroke="#5f6368" stroke-width="2" stroke-linecap="round"></path>
      </svg>
    </button>
    <button aria-label="Settings">
      <svg width="24" height="24" fill="none" stroke="#5f6368" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="3"></circle>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09A1.65 1.65 0 0 0 9 5.6V5a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
      </svg>
    </button>
    <button aria-label="Help">
      <svg width="24" height="24" fill="none" stroke="#5f6368" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"></circle>
        <path d="M9.09 9a3 3 0 1 1 5.83 1c-.27.69-1.12 1.26-1.82 1.53-.54.21-.61.5-.61 1.14M12 17h.01"></path>
      </svg>
    </button>
    <button aria-label="Google apps">
      <svg width="24" height="24" fill="#5f6368" viewBox="0 0 24 24">
        <circle cx="4" cy="4" r="2"></circle>
        <circle cx="12" cy="4" r="2"></circle>
        <circle cx="20" cy="4" r="2"></circle>
        <circle cx="4" cy="12" r="2"></circle>
        <circle cx="12" cy="12" r="2"></circle>
        <circle cx="20" cy="12" r="2"></circle>
        <circle cx="4" cy="20" r="2"></circle>
        <circle cx="12" cy="20" r="2"></circle>
        <circle cx="20" cy="20" r="2"></circle>
      </svg>
    </button>
    <img src="https://i.pravatar.cc/40" alt="User Avatar" style="width: 32px; height: 32px; border-radius: 50%; margin-left: 12px; cursor: pointer;" />
  </header>

  <!-- Email Composer -->
  <div class="email-wrapper">
    <div class="email-container" role="dialog" aria-labelledby="newMessageLabel" aria-modal="true">
      <div class="header" id="newMessageLabel">New Message</div>
      <div class="field">
        <input type="email" id="toInput" placeholder="To" aria-label="Recipient email address" />
      </div>
      <div class="field">
        <input type="text" id="subjectInput" placeholder="Subject" aria-label="Email subject" />
      </div>
      <div class="editor" id="emailBody" contenteditable="true" aria-label="Email body"></div>

      <div class="toolbar" aria-label="Text formatting toolbar">
        <select id="fontSelect" aria-label="Font family">
          <option value="sans-serif" selected>Sans Serif</option>
          <option value="serif">Serif</option>
          <option value="monospace">Monospace</option>
        </select>
        <button type="button" aria-label="Bold" data-command="bold"><b>B</b></button>
        <button type="button" aria-label="Italic" data-command="italic"><i>I</i></button>
        <button type="button" aria-label="Underline" data-command="underline"><u>U</u></button>
        <button type="button" aria-label="Highlight" data-command="hiliteColor" data-value="yellow">A</button>
        <button type="button" aria-label="Bullet list" data-command="insertUnorderedList">•</button>
        <button type="button" aria-label="Numbered list" data-command="insertOrderedList">1.</button>
        <button type="button" aria-label="Outdent" data-command="outdent">⇤</button>
        <button type="button" aria-label="Indent" data-command="indent">⇥</button>
        <button type="button" aria-label="Quote" data-command="formatBlock" data-value="blockquote">“”</button>
        <button type="button" aria-label="Undo" data-command="undo">↺</button>
        <button type="button" aria-label="Clear formatting" id="clearFormat">⨉</button>
      </div>

      <!-- Attachment Input Hidden -->
      <input type="file" id="attachmentInput" multiple style="display:none" />
      <div id="attachmentList" aria-live="polite" aria-atomic="true"></div>

      <div class="send-bar">
        <button type="button" id="sendBtn" aria-label="Send email">Send</button>
        <button type="button" class="icon-btn" id="textColorBtn" aria-label="Change text color">A</button>
        <button type="button" class="icon-btn" id="attachBtn" aria-label="Attach file" title="Attach file">📎</button>
        <button type="button" class="icon-btn" id="emojiBtn" aria-label="Insert emoji" title="Insert emoji">😊</button>
        <button type="button" class="icon-btn" id="insertImageBtn" aria-label="Insert image" title="Insert image">🖼️</button>
        <button type="button" class="icon-btn" id="encryptBtn" aria-label="Encrypt email" title="Encrypt email">🔒</button>
        <button type="button" class="icon-btn" id="editDraftBtn" aria-label="Edit draft" title="Edit draft">✏️</button>
        <button type="button" class="icon-btn" id="moreOptionsBtn" aria-label="More options" title="More options">⋯</button>
      </div>
      <div class="trash-icon" role="button" tabindex="0" aria-label="Delete draft">🗑️</div>
    </div>
  </div>

  <!-- Dragging Script -->
  <script>
    const email = document.querySelector('.email-container');

    let isDragging = false;
    let offsetX = 0, offsetY = 0;

    function clamp(value, min, max) {
      return Math.min(Math.max(value, min), max);
    }

    email.addEventListener('mousedown', (e) => {
      const target = e.target;
      const interactiveTags = ['INPUT', 'BUTTON', 'SELECT', 'TEXTAREA'];
      if (interactiveTags.includes(target.tagName) || target.isContentEditable) return;
      if (window.innerWidth <= 768) return;

      isDragging = true;
      const rect = email.getBoundingClientRect();
      offsetX = e.clientX - rect.left;
      offsetY = e.clientY - rect.top;

      e.preventDefault();
    });

    document.addEventListener('mousemove', (e) => {
      if (!isDragging) return;

      let newLeft = e.clientX - offsetX;
      let newTop = e.clientY - offsetY;

      const padding = 20;
      const containerWidth = email.offsetWidth;
      const containerHeight = email.offsetHeight;

      newLeft = clamp(newLeft, padding, window.innerWidth - containerWidth - padding);
      newTop = clamp(newTop, padding + 56, window.innerHeight - containerHeight - padding);

      email.style.left = newLeft + 'px';
      email.style.top = newTop + 'px';
    });

    document.addEventListener('mouseup', () => {
      isDragging = false;
    });
  </script>

  <!-- Email Formatting and Send Logic -->
  <script>
    const editor = document.getElementById('emailBody');
    const fontSelect = document.getElementById('fontSelect');
    const toolbarButtons = document.querySelectorAll('.toolbar button[data-command]');
    const clearFormatBtn = document.getElementById('clearFormat');
    const sendBtn = document.getElementById('sendBtn');
    const toInput = document.getElementById('toInput');
    const subjectInput = document.getElementById('subjectInput');
    const textColorBtn = document.getElementById('textColorBtn');
    const trashIcon = document.querySelector('.trash-icon');

    const attachBtn = document.getElementById('attachBtn');
    const attachmentInput = document.getElementById('attachmentInput');
    const attachmentList = document.getElementById('attachmentList');

    const emojiBtn = document.getElementById('emojiBtn');
    const insertImageBtn = document.getElementById('insertImageBtn');
    const encryptBtn = document.getElementById('encryptBtn');
    const editDraftBtn = document.getElementById('editDraftBtn');
    const moreOptionsBtn = document.getElementById('moreOptionsBtn');

    // Store selected files for upload
    let selectedFiles = [];

    // Set font family when changed
    fontSelect.addEventListener('change', () => {
      document.execCommand('fontName', false, fontSelect.value);
      editor.focus();
    });

    // Toolbar buttons formatting actions
    toolbarButtons.forEach(button => {
      button.addEventListener('click', () => {
        const command = button.getAttribute('data-command');
        if (command === 'hiliteColor') {
          document.execCommand(command, false, button.getAttribute('data-value'));
        } else if (command === 'formatBlock') {
          document.execCommand(command, false, button.getAttribute('data-value'));
        } else {
          document.execCommand(command, false, null);
        }
        editor.focus();
      });
    });

    // Clear formatting
    clearFormatBtn.addEventListener('click', () => {
      document.execCommand('removeFormat', false, null);
      // Also clear block formats by resetting innerHTML to plain text temporarily
      const text = editor.innerText;
      editor.innerHTML = '';
      editor.innerText = text;
      editor.focus();
    });

    // Text color picker toggle
    textColorBtn.addEventListener('click', () => {
      const color = prompt('Enter text color (name or hex):', '#000000');
      if (color) {
        document.execCommand('foreColor', false, color);
      }
      editor.focus();
    });

    // Trash icon clears all fields
    trashIcon.addEventListener('click', clearDraft);
    trashIcon.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') clearDraft();
    });

    function clearDraft() {
      toInput.value = '';
      subjectInput.value = '';
      editor.innerHTML = '';
      selectedFiles = [];
      renderAttachments();
    }

    // Attach file button opens file selector
    attachBtn.addEventListener('click', () => {
      attachmentInput.click();
    });

    // On file selection
    attachmentInput.addEventListener('change', (e) => {
      const files = Array.from(e.target.files);
      selectedFiles = selectedFiles.concat(files);
      renderAttachments();
      // Clear input to allow re-upload of same files if needed
      attachmentInput.value = '';
    });

    // Render attachment filenames with remove option
    function renderAttachments() {
      attachmentList.innerHTML = '';
      if(selectedFiles.length === 0) return;
      selectedFiles.forEach((file, index) => {
        const span = document.createElement('span');
        span.textContent = file.name;
        span.title = 'Click to remove';
        span.style.cursor = 'pointer';
        span.addEventListener('click', () => {
          selectedFiles.splice(index, 1);
          renderAttachments();
        });
        attachmentList.appendChild(span);
      });
    }

    // Emoji insertion (simple prompt to insert emoji unicode)
    emojiBtn.addEventListener('click', () => {
      const emoji = prompt('Enter emoji or symbol to insert:', '😊');
      if (emoji) {
        insertAtCaret(editor, emoji);
        editor.focus();
      }
    });

    // Insert Image (simple prompt to insert image URL)
    insertImageBtn.addEventListener('click', () => {
      const url = prompt('Enter image URL to insert:');
      if (url) {
        document.execCommand('insertImage', false, url);
        editor.focus();
      }
    });

    // Encrypt email placeholder (alerts for now)
    encryptBtn.addEventListener('click', () => {
      alert('Encrypt email feature coming soon.');
    });

    // Edit draft placeholder
    editDraftBtn.addEventListener('click', () => {
      alert('Edit draft feature coming soon.');
    });

    // More options placeholder
    moreOptionsBtn.addEventListener('click', () => {
      alert('More options feature coming soon.');
    });

    // Insert text at caret position in contenteditable
    function insertAtCaret(editableDiv, text) {
      let sel, range;
      if(window.getSelection) {
        sel = window.getSelection();
        if(sel.getRangeAt && sel.rangeCount) {
          range = sel.getRangeAt(0);
          range.deleteContents();
          range.insertNode(document.createTextNode(text));
          // Move caret after inserted text
          range.setStartAfter(range.endContainer);
          range.collapse(true);
          sel.removeAllRanges();
          sel.addRange(range);
        }
      }
    }

    // Send button logic - submits to backend via AJAX and saves email to DB
    sendBtn.addEventListener('click', () => {
      const to = toInput.value.trim();
      const subject = subjectInput.value.trim();
      const body = editor.innerHTML.trim();

      if (!to) {
        alert('Please enter recipient email address.');
        toInput.focus();
        return;
      }
      if (!validateEmail(to)) {
        alert('Please enter a valid email address.');
        toInput.focus();
        return;
      }
      if (!subject) {
        alert('Please enter the email subject.');
        subjectInput.focus();
        return;
      }
      if (!body) {
        alert('Please enter the email body.');
        editor.focus();
        return;
      }

      // Prepare form data for submission including attachments
      let formData = new FormData();
      formData.append('to', to);
      formData.append('subject', subject);
      formData.append('body', body);

      selectedFiles.forEach((file, index) => {
        formData.append('attachments[]', file);
      });

      sendBtn.disabled = true;
      sendBtn.textContent = 'Sending...';

      fetch("{{ route('emails.send') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Send';
        if (data.success) {
          alert('Email sent and saved successfully!');
          clearDraft();
        } else {
          alert('Error sending email: ' + (data.message || 'Unknown error'));
        }
      })
      .catch(error => {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Send';
        alert('Network or server error sending email.');
        console.error(error);
      });
    });

    function validateEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email.toLowerCase());
    }
  </script>

  @include('admin.footer')
</body>
</html>
