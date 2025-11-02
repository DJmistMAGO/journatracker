@props([
    'id' => 'trix-' . uniqid(),
    'name' => '',
    'value' => '',
    'disabled' => false,
])

<div>
    <input
        id="{{ $id }}"
        type="hidden"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $disabled ? 'disabled' : '' }}
    >
    <trix-editor
        input="{{ $id }}"
        {{ $attributes->merge(['class' => 'trix-content']) }}
        {{ $disabled ? 'disabled' : '' }}
    ></trix-editor>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <style>
            /* Hide file attachment button */
            trix-toolbar .trix-button-group--file-tools {
                display: none !important;
            }

			.trix-toolbar .trix-button-group {
				margin-bottom: 0 !important;
			}

            /* Optional: Add custom styling for the editor */
            trix-editor {
                min-height: 200px;
                max-height: 500px;
                overflow-y: auto;
                border: 1px solid #d9dee3;
                border-radius: 0.375rem;
                padding: 0.75rem;
            }

            trix-editor:focus {
                outline: none;
                border-color: #696cff;
                box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
            }

            /* Style the toolbar */
            trix-toolbar {
                border: 1px solid #d9dee3;
                border-bottom: none;
                border-radius: 0.375rem 0.375rem 0 0;
                background-color: #f8f9fa;
            }

            /* Make sure editor border matches when toolbar is present */
            trix-toolbar + trix-editor {
                border-radius: 0 0 0.375rem 0.375rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
        <script>
            // Disable file attachments silently (no alert)
            document.addEventListener('trix-file-accept', function(event) {
                event.preventDefault();
            });

            // Optional: Prevent dragging files into the editor
            document.addEventListener('trix-initialize', function(event) {
                const editor = event.target;

                editor.addEventListener('drop', function(e) {
                    if (e.dataTransfer.files.length > 0) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                });

                editor.addEventListener('dragover', function(e) {
                    if (e.dataTransfer.types.includes('Files')) {
                        e.preventDefault();
                        e.dataTransfer.dropEffect = 'none';
                    }
                });
            });
        </script>
    @endpush
@endonce
