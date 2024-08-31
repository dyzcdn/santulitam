<x-filament-panels::page>
    <div class="w-0.9 text-center justify-center justify-content-center">
        <div id="reader"></div>
        <div id="result"></div>
    </div>
    @push('styles')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>    
    <style>
        button.html5-qrcode-element,
        select.html5-qrcode-element,
        button.scanapp-button {
            appearance: none;
            background-color: #FAFBFC;
            border: 1px solid rgba(27, 31, 35, 0.15);
            border-radius: 6px;
            box-shadow: rgba(27, 31, 35, 0.04) 0 1px 0, rgba(255, 255, 255, 0.25) 0 1px 0 inset;
            box-sizing: border-box;
            color: #24292E;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            list-style: none;
            padding: 6px 16px;
            position: relative;
            transition: background-color 0.2s cubic-bezier(0.3, 0, 0.5, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            white-space: nowrap;
            word-wrap: break-word;
            margin-bottom: 5px;
        }
    </style>
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
    
        async function fetchStudentData(nim) {
        try {
            const response = await fetch('/api-students');
            const data = await response.json();
            const student = data.data.find(student => student.nim === nim);

            if (student) {
                return student;
            } else {
                return null;
            }
        } catch (error) {
            console.error('Error fetching student data:', error);
            return null;
        }
    }

    async function fetchPeletonName(peletonId) {
        try {
            const response = await fetch(`/api-peleton/${peletonId}`);
            const data = await response.json();

            if (data.success) {
                return data.data.name;
            } else {
                return 'Peleton not found';
            }
        } catch (error) {
            console.error('Error fetching peleton data:', error);
            return 'Error fetching peleton data';
        }
    }

    async function onScanSuccess(decodedText, decodedResult) {
        const decodedNim = atob(decodedText);

        // Fetch student details
        const student = await fetchStudentData(decodedNim);

        // Handle the scanned code after decoding
        let resultHtml = `
            <h1>Student Detail</h1>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">Attribute</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">NIM</td>
                        <td style="border: 1px solid #ddd; padding: 8px;"><b>${decodedNim}</b></td>
                    </tr>`;

        if (student) {
            const peletonName = await fetchPeletonName(student.peleton_id);

            resultHtml += `
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Name</td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><b>${student.name}</b></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">Peleton</td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><b>${peletonName}</b></td>
                </tr>`;
        } else {
            resultHtml += `
                <tr>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Name not found</td>
                </tr>`;
        }

        resultHtml += `
                </tbody>
            </table>
            <br>
            <form action="{{ route('scan-attendances.store') }}" method="POST">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="nim" value="${decodedNim}">
                <input type="hidden" name="peleton_id" value="${student.peleton_id}">
                <input type="hidden" name="theme_id" value="${themeId}">
                <button type="submit" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">Submit & Scan again</button>
            </form>
        `;

        document.getElementById("result").innerHTML = resultHtml;
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
