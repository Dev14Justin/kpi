@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-white/10 dark:bg-[#282828] dark:text-gray-300 focus:border-accent dark:focus:border-accent focus:ring-accent dark:focus:ring-accent rounded-md shadow-sm']) }}>