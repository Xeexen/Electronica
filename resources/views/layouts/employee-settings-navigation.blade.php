<aside wire:ignore
    class="flex pb-4 overflow-x-auto border-b border-gray-900/5 xl:block xl:w-64 xl:flex-none xl:border-0 xl:pb-0">
    <nav class="flex-none">
        <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap xl:flex-col">
            <li>
                <a href="{{ route('employee.settings.general') }}" @class(['group flex gap-x-3 rounded-md py-2 pl-2 pr-3
                    text-sm leading-6 font-semibold', 'bg-gray-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                    request()->routeIs('employee.settings.general'), 'text-gray-700 hover:text-sky-600 hover:bg-gray-50
                    dark:text-gray-400 dark:hover:bg-slate-800 dark:hover:text-white' => !
                    request()->routeIs('employee.settings.general')])
                    >
                    <x-heroicon-o-building-storefront @class(['h-6 w-6 shrink-0', 'text-sky-600 dark:text-white'=>
                        request()->routeIs('employee.settings.general'), 'text-gray-400 group-hover:text-sky-600
                        dark:group-hover:bg-slate-800 dark:group-hover:text-white' => !
                        request()->routeIs('employee.settings.general')]) />
                        {{ __('General') }}
                </a>
            </li>
            <li>
                <a href="{{ route('employee.settings.user.list') }}" @class(['group flex gap-x-3 rounded-md py-2 pl-2
                    pr-3 text-sm leading-6 font-semibold', 'bg-gray-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                    request()->routeIs('employee.settings.user.*'), 'text-gray-700 hover:text-sky-600 hover:bg-gray-50
                    dark:text-gray-400 dark:hover:bg-slate-800 dark:hover:text-white' => !
                    request()->routeIs('employee.settings.user.*')])
                    >
                    <x-heroicon-o-user-circle @class(['h-6 w-6 shrink-0', 'text-sky-600 dark:text-white'=>
                        request()->routeIs('employee.settings.user.*'), 'text-gray-400 group-hover:text-sky-600
                        dark:group-hover:bg-slate-800 dark:group-hover:text-white' => !
                        request()->routeIs('employee.settings.user.*')]) />
                        {{ __('Users') }}
                </a>
            </li>
        </ul>
    </nav>
</aside>