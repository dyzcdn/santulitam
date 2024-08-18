<x-filament-panels::page>
    {{-- <h1>Hallo Semua</h1> --}}
    <div class="w-0.9 text-center justify-center justify-content-center">
        <div id="reader"></div>
        <div id="result"></div>
    </div>
    {{-- <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center justify-center">
                    <h5 class="card-title
                    ">Card title</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div> --}}

    @push('styles')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>    
    @endpush
    @push('scripts')
    <script>
        // button reset
        function reset() {
            location.reload(true);
        }

        const scanner = new Html5QrcodeScanner(
            "reader", { fps: 20, qrbox: { width: 400, height: 400 } }, false
        );

        scanner.render(success, error);

        var domain = "https://" + window.location.host + "/";

        function success(result) {
            document.getElementById("result").innerHTML = `
                <h2>Success!</h2>
                <p>Result: <a href="${domain}${result}">${result}</a></p>
                <br>
                <button style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action" onclick="reset()">Scan again</button>
            `;

            scanner.clear();
            document.getElementById("reader").remove();
        }

        function error(err) {
            console.error(err);
        }
    </script>
    @endpush
</x-filament-panels::page>
