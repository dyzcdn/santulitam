<x-filament-panels::page>
    <div class="w-0.9 text-center justify-center justify-content-center">
        <div id="reader"></div>
        <div id="result"></div>
    </div>
    @push('styles')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>    
    @endpush
    @push('scripts')
    <script>
        const formatsToSupport = [
            Html5QrcodeSupportedFormats.QR_CODE,
            Html5QrcodeSupportedFormats.UPC_A,
            Html5QrcodeSupportedFormats.UPC_E,
            Html5QrcodeSupportedFormats.UPC_EAN_EXTENSION,
        ];

        const scanner = new Html5QrcodeScanner(
            "reader", 
            { fps: 20, qrbox: { width: 400, height: 400 }, formatsToSupport: formatsToSupport }
        );
        
        const csrfToken = '{{ csrf_token() }}';
        const themeId = 3;

        function onScanSuccess(decodedText, decodedResult) {
            // Decode Base64
            const decodedNim = atob(decodedText);

            // Handle the scanned code after decoding
            document.getElementById("result").innerHTML = `
                <h2>Data peserta</h2>
                <p>NIM: <b>${decodedNim}</b></p>
                <br>
                <form action="{{ route('scan-attendances.store') }}" method="POST">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="nim" value="${decodedNim}">
                    <input type="hidden" name="theme_id" value="${themeId}">
                    <button type="submit" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">Scan again</button>
                </form>
            `;

            scanner.clear();
            document.getElementById("reader").remove();
        }

        function onScanError(err) {
            console.error(`Scan error: ${err}`);
        }

        scanner.render(onScanSuccess, onScanError);
    </script>
    @endpush
</x-filament-panels::page>
