<div>
    <!-- Meta title & description -->
    <x-slot:title>
        {{ __('Dashboard') }}
    </x-slot:title>

    <!-- Page title & actions -->
    <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-medium leading-6 text-slate-900 sm:truncate dark:text-slate-100">
                {{ __('Dashboard') }}
            </h1>
        </div>
    </div>

    <!-- Page content -->
    <div class="p-4 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <x-card>
                <x-slot:content>
                    <div class="flex items-center justify-between">
                        <dl>
                            <dt class="text-sm font-medium truncate text-slate-500">{{ __('Nuevas Ordenes') }}</dt>
                            <dd class="mt-1 text-3xl font-semibold text-sky-500">sis</dd>
                        </dl>
                        <div x-data="{
                                init() {
                                    new ApexCharts($refs.chartElement, {
                                        series: [{
                                            name: 'Orders',
                                            data: 
                                        }],
                                        chart: {
                                            type: 'bar',
                                            width: 100,
                                            height: 46,
                                            sparkline: {
                                                enabled: true,
                                            }
                                        },
                                        colors: ['#0ea5e9'],
                                        plotOptions: {
                                            bar: {
                                                columnWidth: '80%',
                                            }
                                        },
                                        xaxis: {
                                            crosshairs: {
                                                width: 1,
                                            },
                                        },
                                        tooltip: {
                                            fixed: {
                                                enabled: false,
                                            },
                                            x: {
                                                show: false,
                                            },
                                            y: {
                                                title: {
                                                    formatter: function (seriesName) {
                                                        return '';
                                                    }
                                                }
                                            },
                                            marker: {
                                                show: false,
                                            }
                                        }
                                    }).render();
                                }
                            }" class="md:hidden lg:block">
                            <div x-ref="chartElement"></div>
                        </div>
                    </div>
                </x-slot:content>
            </x-card>

            <x-card>
                <x-slot:content>
                    <div class="flex items-center justify-between">
                        <dl>
                            <dt class="text-sm font-medium truncate text-slate-500">{{ __('Ventas') }}</dt>
                            <dd class="mt-1 text-3xl font-semibold text-sky-500"></dd>
                        </dl>
                        <div x-data="{
                                init() {
                                    new ApexCharts($refs.chartElement, {
                                        series: [{
                                            name: 'Orders',
                                            data: 
                                        }],
                                        chart: {
                                            type: 'bar',
                                            width: 100,
                                            height: 46,
                                            sparkline: {
                                                enabled: true,
                                            }
                                        },
                                        colors: ['#0ea5e9'],
                                        plotOptions: {
                                            bar: {
                                                columnWidth: '80%',
                                            }
                                        },
                                        xaxis: {
                                            crosshairs: {
                                                width: 1,
                                            },
                                        },
                                        tooltip: {
                                            fixed: {
                                                enabled: false,
                                            },
                                            x: {
                                                show: false,
                                            },
                                            y: {
                                                title: {
                                                    formatter: function (seriesName) {
                                                        return '';
                                                    }
                                                }
                                            },
                                            marker: {
                                                show: false,
                                            }
                                        }
                                    }).render();
                                }
                            }" class="md:hidden lg:block">
                            <div x-ref="chartElement"></div>
                        </div>
                    </div>
                </x-slot:content>
            </x-card>

            <x-card>
                <x-slot:content>
                    <div class="flex items-center justify-between">
                        <dl>
                            <dt class="text-sm font-medium truncate text-slate-500">{{ __('Clientes') }}</dt>
                            <dd class="mt-1 text-3xl font-semibold text-sky-500"></dd>
                        </dl>
                        <div x-data="{
                                init() {
                                    new ApexCharts($refs.chartElement, {
                                        series: [{
                                            name: 'Orders',
                                            data: 
                                        }],
                                        chart: {
                                            type: 'bar',
                                            width: 100,
                                            height: 46,
                                            sparkline: {
                                                enabled: true,
                                            }
                                        },
                                        colors: ['#0ea5e9'],
                                        plotOptions: {
                                            bar: {
                                                columnWidth: '80%',
                                            }
                                        },
                                        xaxis: {
                                            crosshairs: {
                                                width: 1,
                                            },
                                        },
                                        tooltip: {
                                            fixed: {
                                                enabled: false,
                                            },
                                            x: {
                                                show: false,
                                            },
                                            y: {
                                                title: {
                                                    formatter: function (seriesName) {
                                                        return '';
                                                    }
                                                }
                                            },
                                            marker: {
                                                show: false,
                                            }
                                        }
                                    }).render();
                                }
                            }" class="md:hidden lg:block">
                            <div x-ref="chartElement"></div>
                        </div>
                    </div>
                </x-slot:content>
            </x-card>
        </div>

        <div class="mt-5">
            <x-card>

                <x-slot name="content">
                    <div x-data="{
                            init() {
                                const formatter = new Intl.NumberFormat('{{ config('app.locale') }}', {
                                    style: 'currency',
                                    currency: '{{ config('app.currency') }}',
                                });
                                new ApexCharts($refs.chartElement, {
                                    series: [{
                                        name: 'Amount',
                                        data: 
                                    }],
                                    chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: {
                                            show: false,
                                        }
                                    },
                                    grid: {
                                        show: true,
                                        borderColor: theme === 'dark' ? '#374151' : '#e2e8f0',
                                    },
                                    colors: ['#0ea5e9'],
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth'
                                    },
                                    xaxis: {
                                        type: 'datetime',
                                        tooltip: {
                                            enabled: false
                                        },
                                        categories: ,
                                        labels: {
                                            style: {
                                                colors: theme === 'dark' ? '#e2e8f0' : '#111827',
                                            }
                                        },
                                    },
                                    yaxis: {
                                        labels: {
                                            formatter: function (value) {
                                                return formatter.format(value);
                                            },
                                            style: {
                                                colors: theme === 'dark' ? '#e2e8f0' : '#111827',
                                            }
                                        },
                                    },
                                    tooltip: {
                                        theme: 'dark',
                                        x: {
                                            format: 'dd/MM/yyyy'
                                        },
                                    },
                                    title: {
                                        text: 'Sales report',
                                        offsetX: 5,
                                        style: {
                                            color: theme === 'dark' ? '#e2e8f0' : '#111827',
                                            fontFamily: 'Inter',
                                            fontSize: '18px',
                                            fontWeight: '500',
                                        }
                                    }
                                }).render();
                            }
                        }" class="-mx-3 -mt-2 -mb-3">
                        <div x-ref="chartElement"></div>
                    </div>
                    asdasdawe
                </x-slot>
            </x-card>
        </div>

        <div class="grid grid-cols-1 gap-5 mt-5 xl:grid-cols-2">
            <x-card>
                <x-slot name="header">
                    <h3 class="text-lg font-medium leading-6 text-slate-900 dark:text-slate-200">
                        {{ __('Most recent orders') }}
                    </h3>
                </x-slot>
                <x-slot name="content">
                    <div class="-mx-4 -my-6 sm:-m-6">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <table class="min-w-full divide-y divide-slate-200 dark:divide-white/10">
                                    <thead class="bg-slate-50 dark:bg-white/5">
                                        <tr>
                                            <th
                                                class="py-3.5 px-4 sm:pl-6 font-medium text-left text-xs text-slate-500 tracking-wider uppercase dark:text-slate-200">
                                                {{ __('ID') }}
                                            </th>
                                            <th
                                                class="py-3.5 px-4 font-medium text-left text-xs text-slate-500 tracking-wider uppercase dark:text-slate-200">
                                                {{ __('Customer') }}
                                            </th>
                                            <th
                                                class="py-3.5 px-4 font-medium text-right text-xs text-slate-500 tracking-wider uppercase dark:text-slate-200">
                                                {{ __('Total') }}
                                            </th>
                                            <th
                                                class="py-3.5 px-4 sm:pr-6 font-medium text-right text-xs text-slate-500 tracking-wider uppercase dark:text-slate-200">
                                                {{ __('Date') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-white/20">
                                        <tr>
                                            <td
                                                class="px-4 py-4 text-sm font-medium whitespace-nowrap sm:px-6 text-slate-900 dark:text-slate-400">
                                                <a href="" class="hover:text-blue-500 dark:hover:text-sky-400">

                                                    ID </a>
                                            </td>
                                            <td
                                                class="px-4 py-4 text-sm font-medium whitespace-nowrap text-slate-900 dark:text-slate-400">
                                                @if($clientes)
                                                <a href="" class="hover:text-blue-500 dark:hover:text-sky-400">
                                                    Nombre
                                                </a>
                                                @else
                                                {{ __('No Hay Clientes') }}
                                                @endif
                                            </td>
                                            <td
                                                class="px-4 py-4 text-sm text-right whitespace-nowrap text-slate-900 tabular-nums dark:text-slate-400">
                                                <x-money :amount="20" :currency="config('app.currency')" />
                                            </td>
                                            <td
                                                class="px-4 py-4 text-sm text-right whitespace-nowrap sm:pr-6 text-slate-900 tabular-nums dark:text-slate-400">
                                                {{-- {{ $orden->created_at->format('Y-m-d') }} --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-card>

            <x-card>
                <x-slot name="header">
                    <h3 class="text-lg font-medium leading-6 text-slate-900 dark:text-slate-200">
                        {{ __('Top selling products') }}
                    </h3>
                </x-slot>
                <x-slot name="content">
                    <div class="-mx-4 -my-6 sm:-m-6">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-card>
        </div>
    </div>
</div>