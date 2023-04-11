<div {{ $attributes->merge(['type' => 'submit', 'class' => 'w-52 h-12 gap-1 inline-flex items-center bg-red-600 border border-transparent rounded-md']) }}>

<button class= 'w-3/4 h-full bg-red-500 text-sm font-roboto text-white'>
    {{ $slot }}
</button>

<button class='w-1/4 h-full p-3 bg-red-500'>
<svg class='w-full h-full' id="eDNLxM7nWHk1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
viewBox="0 0 24 24" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><g>
    <path d="M14,10v7m-4-7v7M6,6v11.8c0,1.1201,0,1.6798.21799,2.1076.19174.3763.49748.6829.87381.8746C7.5192,21,8.07899,21,9.19691,21h5.60619c1.1179,0,1.6769,0,2.1043-.2178.3763-.1917.6831-.4983.8748-.8746C18,19.4802,18,18.921,18,17.8031L18,6M6,6h2M6,6h-2M8,6h8M8,6c0-.93188,0-1.39759.15224-1.76514.20299-.49005.59208-.87963,1.08214-1.08262C9.60192,3,10.0681,3,11,3h2c.9319,0,1.3978,0,1.7654.15224.49.20299.8793.59257,1.0823,1.08262C15.9999,4.6024,16,5.06812,16,6m0,0h2m0,0h2" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g></svg>
</button>

</div>