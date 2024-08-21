<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
</head>
<body>
  <!-- component -->
<div class="bg-black text-white flex min-h-screen flex-col items-center pt-16 sm:justify-center sm:pt-0">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <a href="#">
        <div class="text-foreground font-semibold text-2xl tracking-tighter mx-auto flex items-center gap-2">
            <div>
                <img src="{{ url('/logo/santulitam-logo.png') }}" alt="Logo Karisma Santulitam" style="height: 50px">
            </div>
            Karisma Santulitam
        </div>
    </a>
    <div class="relative mt-12 w-full max-w-lg sm:mt-10">
        <div class="relative -mb-px h-px w-full bg-gradient-to-r from-transparent via-sky-300 to-transparent"
            bis_skin_checked="1"></div>
        <div
            class="mx-5 border dark:border-b-white/50 dark:border-t-white/50 border-b-white/20 sm:border-t-white/20 shadow-[20px_0_20px_20px] shadow-slate-500/10 dark:shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl lg:shadow-none">
            <div class="flex flex-col p-6">
                <h3 class="text-xl font-semibold leading-6 tracking-tighter">Pendataan Cofasilitatot</h3>
                <p class="mt-1.5 text-sm font-medium text-white/50">Hallo #KsatriaPetir, silahkan isi formulir untuk pendataan cofasilitator SAKARITAM.
                </p>
            </div>
            <div class="p-6 pt-0">
                <form action="{{ route('pendataan-cofasilitator.store') }}" method="POST">
                    @csrf
                    <div>
                        <div>
                            <div
                                class="group relative rounded-lg border focus-within:border-sky-200 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-sky-300/30">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-gray-400">Nama</label>
                                </div>
                                <input type="text" name="name" placeholder="Nama Lengkap" autocomplete="on" style="text-transform: capitalize;" required
                                    autocomplete="off"
                                    class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 file:rounded-full file:border-0 file:bg-accent file:px-4 file:py-2 file:font-medium placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 sm:leading-7 text-foreground">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <div
                                class="group relative rounded-lg border focus-within:border-sky-200 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-sky-300/30">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-gray-400">Username</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="text" name="username" placeholder="username" required autocomplete="on"
                                        class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4" x-data="{ show: true }">
                        <div>
                            <div
                                class="group relative rounded-lg border focus-within:border-sky-200 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-sky-300/30">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-gray-400">Password</label>
                                </div>
                                <div class="flex items-center">
                                    <input :type="show ? 'password' : 'text'" name="password" placeholder="Password" required autocomplete="on"
                                        class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                                        <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                            :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                            viewbox="0 0 576 512">
                                            <path fill="currentColor"
                                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                            </path>
                                        </svg>
                    
                                        <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                            :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                            viewbox="0 0 640 512">
                                            <path fill="currentColor"
                                            d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                            </path>
                                        </svg>
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <div
                                class="group relative rounded-lg border focus-within:border-sky-200 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-sky-300/30">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-gray-400">NIM</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="text" name="nim" placeholder="202400123" required autocomplete="on"
                                        class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <div
                                class="group relative rounded-lg border focus-within:border-sky-200 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-sky-300/30">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-gray-400">Peleton</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="text" name="peleton" placeholder="Peleton" autocomplete="on" style="text-transform: capitalize;" required
                                    autocomplete="off"
                                    class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 file:rounded-full file:border-0 file:bg-accent file:px-4 file:py-2 file:font-medium placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 sm:leading-7 text-foreground">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <div
                                class="group relative rounded-lg border focus-within:border-sky-200 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-sky-300/30">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-gray-400">Email</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="email" name="email" placeholder="karisma@santulitam.id (email kampus atau email pribadi)" autocomplete="on"
                                        class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div>
                            <div
                                class="group relative rounded-lg border focus-within:border-sky-200 px-3 pb-1.5 pt-2.5 duration-200 focus-within:ring focus-within:ring-sky-300/30">
                                <div class="flex justify-between">
                                    <label
                                        class="text-xs font-medium text-muted-foreground group-focus-within:text-white text-gray-400">No WhatsApp</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="text" name="phone" placeholder="081234567890" autocomplete="on"
                                        class="block w-full border-0 bg-transparent p-0 text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <span class="text-sm font-bold">Apakah Data Sudah Valid?</span>
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" required
                                class="outline-none focus:outline focus:outline-sky-300">
                            <span class="text-xs">Ya, Data Sudah Valid</span>
                        </label>
                    </div>
                    <div class="mt-4 flex items-center justify-end gap-x-2">
                        <button
                            class="font-semibold hover:bg-black hover:text-white hover:ring hover:ring-white transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-white text-black h-10 px-4 py-2"
                            type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>