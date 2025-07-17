<x-app-layout>
    <x-slot:title>Home</x-slot>

    <div class="container mx-auto flex justify-around space-x-4 mb-10 flex-wrap py-16">
        <div class="w-full md:w-[45%]">
            <img src="{{ asset('images/hero.jpg') }}" alt="Hero Image" class="w-full rounded-lg shadow-lg h-[350px]" />
        </div>
        <div class="w-full md:w-[45%]">
            <h2 class="text-3xl font-semibold my-5">Best Job Searching Portal</h2>
            <p class="text-gray-600 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam aliquam voluptas totam earum commodi facilis illum rem excepturi vel perferendis quae, dicta dolorum necessitatibus aspernatur libero doloremque aut quod? Libero culpa id quia deleniti tempore ea error molestiae voluptatem harum. </p>
            <a href="{{ route('user.login') }}" class="btn">Search Job</a>
            <a href="{{ route('employer.login') }}" class="btn">Post Job</a>
        </div>
    </div>

    <div class="container mx-auto flex justify-around space-x-4 mb-10 flex-wrap">
        <div class="w-full md:w-[45%]">
            <h2 class="text-3xl font-semibold mb-5">About Us</h2>
            <p class="text-gray-600 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam aliquam voluptas totam earum commodi facilis illum rem excepturi vel perferendis quae, dicta dolorum necessitatibus aspernatur libero doloremque aut quod? Libero culpa id quia deleniti tempore ea error molestiae voluptatem harum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt autem assumenda, officia blanditiis nam doloremque quasi rem quia velit sed numquam quos dolorem? Sunt similique voluptas, esse ipsum repellendus et accusantium voluptates architecto odit nisi tempora voluptatum.</p>
        </div>
        <div class="w-full md:w-[45%]">
            <img src="{{ asset('images/about.png') }}" alt="About Image" class="w-full rounded-lg shadow-lg h-[350px]" />
        </div>
    </div>

    <div class="container mx-auto flex justify-around space-x-4 mb-10 flex-wrap">
        <div class="w-full md:w-[45%]">
            <img src="{{ asset('images/feature-1.jpg') }}" alt="Feature Image" class="w-full rounded-lg shadow-lg h-[350px]" />
        </div>
        <div class="w-full md:w-[45%]">
            <h2 class="text-3xl font-semibold my-5">Searching For Jobs</h2>
            <p class="text-gray-600 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam aliquam voluptas totam earum commodi facilis illum rem excepturi vel perferendis quae, dicta dolorum necessitatibus aspernatur libero doloremque aut quod? Libero culpa id quia deleniti tempore ea error molestiae voluptatem harum. Blanditiis, ipsam. Velit illum a magnam dolore natus assumenda ullam dolorem molestias dicta id odio error voluptatum repellat soluta, doloribus consequuntur aperiam reiciendis alias quibusdam dolorum similique architecto? Hic asperiores in laborum vel amet totam.</p>
            <a href="{{ route('user.login') }}" class="btn">User Login</a>
            <a href="{{ route('user.register') }}" class="btn">User Register</a>
        </div>
    </div>

    <div class="container mx-auto flex justify-around space-x-4 mb-10 flex-wrap">
        <div class="w-full md:w-[45%] mb-5">
            <h2 class="text-3xl font-semibold my-5">Searching For Employee</h2>
            <p class="text-gray-600 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam aliquam voluptas totam earum commodi facilis illum rem excepturi vel perferendis quae, dicta dolorum necessitatibus aspernatur libero doloremque aut quod? Libero culpa id quia deleniti tempore ea error molestiae voluptatem harum. Blanditiis, ipsam. Velit illum a magnam dolore natus assumenda ullam dolorem molestias dicta id odio error voluptatum repellat soluta, doloribus consequuntur aperiam reiciendis alias quibusdam dolorum similique architecto? Hic asperiores in laborum vel amet totam.</p>
            <a href="{{ route('employer.login') }}" class="btn">Employer Login</a>
            <a href="{{ route('employer.register') }}" class="btn">Employer Register</a>
        </div>
        <div class="w-full md:w-[45%]">
            <img src="{{ asset('images/feature-2.jpg') }}" alt="Feature Image" class="w-full rounded-lg shadow-lg h-[350px]" />
        </div>
    </div>

    <div class="container mx-auto flex justify-around space-x-4 mb-10 flex-wrap">
        <div class='w-full md:w-[45%]'>
            <img src="{{ asset('images/achievement.jpg') }}" alt="Achievement Image" class="w-full rounded-lg shadow-lg h-[350px]" />
        </div>
        <div class='w-full md:w-[45%]'>
            <h2 class="text-3xl font-semibold my-5">Our Alltime Achievement</h2>
            <p class="text-gray-600 mb-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione quos doloremque temporibus obcaecati vero. Eveniet exercitationem odit debitis natus nihil.</p>
            <div class="flex items-center justify-between flex-wrap">
                <div class="flex-auto w-1/4 mx-2 p-4 shadow-2xl rounded-xl text-center">
                    <h3 class="mb-4 text-xl font-bold capitalize text-blue-800">2000+</h3>
                    <h4 class="text-xl font-medium capitalize">total users</h4>
                </div>
                <div class="flex-auto w-1/4 mx-2 p-4 shadow-2xl rounded-xl text-center"></h3>
                    <h3 class="mb-4 text-xl font-bold capitalize text-blue-800">50+</h3>
                    <h4 class="text-xl font-medium capitalize">total employers</h4>
                </div>
                <div class="flex-auto w-1/4 mx-2 p-4 shadow-2xl rounded-xl text-center">
                    <h3 class="mb-4 text-xl font-bold capitalize text-blue-800">1000+</h3>
                    <h4 class="text-xl font-medium capitalize">generated jobs</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-10">
        <h3 class="text-3xl font-semibold mb-5">Testimonial</h3>
        <div class="flex items-center justify-between flex-wrap">
            <div class="flex-auto w-full md:w-5/12 md:mr-5 mb-5 shadow-lg rounded-xl">
                <img src="{{ asset('images/testimonial-1.jpg') }}" alt="Testimonial Image" class="h-64 w-full rounded-xl" />
                <div class="p-5">
                    <div class="flex items-center justify-between flex-wrap">
                    <h3 class="text-xl font-medium capitalize mb-3">John Doe</h3>
                    <div class="text-amber-600">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    </div>
                    <p class="text-sm font-light leading-6 mb-3 lg:font-medium">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus eos vel eius tempore itaque omnis totam, maiores ipsum quos commodi est. Reprehenderit eaque voluptatem, magnam amet mollitia voluptates architecto libero.
                    </p>
                </div>
            </div>
            <div class="flex-auto w-full md:w-5/12 md:mr-5 mb-5 shadow-lg rounded-xl">
                <img src="{{ asset('images/testimonial-2.jpg') }}" alt="Testimonial Image" class="h-64 w-full rounded-xl" />
                <div class="p-5">
                    <div class="flex items-center justify-between flex-wrap">
                    <h3 class="text-xl font-medium capitalize mb-3">Jane Dae</h3>
                    <div class="text-amber-700">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    </div>
                    <p class="text-sm font-light leading-6 mb-3 lg:font-medium">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus eos vel eius tempore itaque omnis totam, maiores ipsum quos commodi est. Reprehenderit eaque voluptatem, magnam amet mollitia voluptates architecto libero.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto mt-10">
        <h3 class="text-3xl font-semibold my-5">Contact Us</h3>
        <p class='text-gray-600 mb-5'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo perspiciatis nam rem cumque quibusdam ipsa cupiditate, nemo iure, possimus labore saepe officia impedit unde dolor dolores. Natus voluptatum iure iusto odit eius esse.
        <div class="flex items-center justify-between flex-wrap">
            <div class="flex-auto w-full md:w-5/12 md:mr-5 mb-5">
                <form action="#" class="shadow-xl rounded-2xl p-5">
                    <div>
                        <input type="text" name="name" id="name" placeholder="enter your name" class="w-full p-2 mb-3 rounded-lg text-black placeholder:text-slate-800 placeholder:capitalize outline-0 border border-blue-500 focus:ring-4 focus:ring-blue-200" />
                    </div>
                    <div>
                        <input type="email" name="email" id="email" placeholder="enter your email" class="w-full p-2 mb-3 rounded-lg text-black placeholder:text-slate-800 placeholder:capitalize outline-0 border border-blue-500 focus:ring-4 focus:ring-blue-200" />
                    </div>
                    <div>
                        <textarea name="message" id="message" placeholder="enter your message" class="w-full p-2 mb-3 rounded-lg text-black placeholder:text-slate-800 placeholder:capitalize outline-0 border border-blue-500 focus:ring-4 focus:ring-blue-200"></textarea>
                    </div>
                    <button class="btn">send</button>
                </form>
            </div>
            <div class="flex-auto w-full md:w-5/12 md:mr-5 mb-5">
                <img src="{{ asset('images/contact-us.jpg') }}" alt="contact" class="h-64 w-full rounded-xl" />
            </div>
        </div>
    </div>

    <footer class="bg-blue-800">
        <div class="container px-10 mx-auto mt-10 py-5 flex items-center justify-between flex-wrap">
            <div class="flex-auto w-full md:w-5/12 md:mr-5 lg:w-3/12 mx-auto mb-5">
                <h3 class='text-3xl font-bold text-white mb-3'>LOGO</h3>
                <p class="mb-3 text-gray-50 text-lg">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum nisi at atque perspiciatis velit quis. Aperiam veritatis dolore dolorem nulla consequatur excepturi debitis? Dolore, ducimus.</p>
                <div class="mb-3">
                    <i class="fa-brands fa-facebook text-white mr-2 text-2xl"></i>
                    <i class="fa-brands fa-twitter text-white mr-2 text-2xl"></i>
                    <i class="fa-brands fa-square-instagram text-white mr-2 text-2xl"></i>
                    <i class="fa-brands fa-youtube text-white mr-2 text-2xl"></i>
                </div>
            </div>
            <div class="flex-auto w-full md:w-5/12 md:mr-5 lg:w-3/12 mx-auto mb-5">
                <h2 class="text-xl font-bold text-white capitalize mb-3">Important Link</h2>
                <ul>
                    <li class="mb-2">
                        <a href="#home" class="text-white capitalize text-base">home</a>
                    </li>
                    <li class="mb-2">
                        <a href="#about" class="text-white capitalize text-base">about</a>
                    </li>
                    <li class="mb-2">
                        <a href="#blog" class="text-white capitalize text-base">blog</a>
                    </li>
                    <li class="mb-2">
                        <a href="#testimonial" class="text-white capitalize text-base">testimonial</a>
                    </li>
                    <li class="mb-2">
                        <a href="#newsletter" class="text-white capitalize text-base">newsletter</a>
                    </li>
                </ul>
            </div>
            <div class="flex-auto w-full md:w-5/12 lg:w-3/12 mx-auto mb-5">
                <h2 class="text-xl font-bold text-white capitalize mb-3">Support</h2>
                <ul>
                    <li class="mb-2">
                        <a href="#" class="text-white capitalize mb-3">help</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white capitalize mb-3">customer cariar</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white capitalize mb-3">blog</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white capitalize mb-3">locations</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white capitalize mb-3">faq</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="bg-blue-700 text-center p-2">
        <p class="text-white capitalize text-lg">create by sumanta ghosh &copy; 2025 all rights reserved</p>
    </div>
</x-app-layout>