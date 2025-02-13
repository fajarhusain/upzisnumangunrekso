<input
    {{ $attributes->merge([
        'type' => 'file',
        'class' =>
            'w-full max-w-md text-sm border border-gray-300 rounded-md overflow-clip bg-gray-50/50 file:mr-4 file:cursor-pointer file:border-none file:bg-gray-50 file:px-4 file:py-2 file:font-medium file:text-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-700 dark:bg-gray-900/50 dark:file:bg-gray-900 dark:file:text-white dark:focus-visible:outline-white',
    ]) }} />
