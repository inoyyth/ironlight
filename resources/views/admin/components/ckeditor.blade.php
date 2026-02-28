@php
    $cdnUrl = 'https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js';
@endphp

<script src="{{ $cdnUrl }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Find all textarea elements with 'ckeditor' class
    const textareas = document.querySelectorAll('textarea.ckeditor');
    
    textareas.forEach(function(textarea) {
        // Initialize CKEditor
        ClassicEditor
            .create(textarea, {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        '|',
                        'sourceEditing',
                        '|',
                        'undo',
                        'redo'
                    ]
                },
                language: 'en',
                // image: {
                //     toolbar: [
                //         'imageTextAlternative',
                //         'imageStyle:full',
                //         'imageStyle:side'
                //     ]
                // },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                sourceEditing: {
                    allowedContent: true
                },
                licenseKey: ''
            })
            .then(editor => {
                // Store editor instance
                textarea.ckeditorInstance = editor;
                
                // Update textarea value on change
                editor.model.document.on('change:data', () => {
                    textarea.value = editor.getData();
                });
                
                // Handle form submission
                const form = textarea.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        textarea.value = editor.getData();
                    });
                }
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });
    });
});
</script>

<style>
.ck-editor__editable {
    min-height: 200px;
}

.ck-content {
    font-size: 14px;
    line-height: 1.6;
}

/* Custom styling for admin theme */
.ck.ck-toolbar {
    background: #f9fafb;
    border-color: #e5e7eb;
}

.ck.ck-toolbar .ck-button {
    color: #374151;
}

.ck.ck-toolbar .ck-button:hover {
    background: #e5e7eb;
}

.ck.ck-toolbar .ck-button.ck-on {
    background: #3b82f6;
    color: white;
}

/* Source editing mode styling */
.ck-source-editing-area {
    font-family: 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.4;
}

.ck-source-editing-area textarea {
    min-height: 200px;
    padding: 10px;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    background: #f9fafb;
}

/* Source editing button styling */
.ck-source-editing-button .ck-button__label {
    font-weight: 500;
}
</style>
