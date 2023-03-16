<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <div class="mt-8" x-data="{ apiData: {{ json_encode($data) }},
                         loading:false,
                        refreshData: async function() {
                            this.loading = true;
                            const response = await fetch('/refresh-data');
                            const newData = await response.json();
                            this.apiData = newData;
                            this.loading = false;
                        }
                
                       }">
                       <div  x-show="!loading"> 
                       <h3 class="text-xl font-semibold" x-text="apiData.title"></h3>

                        <table class="table-auto w-full mt-4">
                            <thead>
                                <tr>
                                    <template x-for="header in apiData.data.headers">
                                        <th class="px-4 py-2" x-text="header"></th>
                                    </template>
                                </tr>
                            </thead>
                            <tbody x-show="apiData.data.rows">
                                <template x-for="(row, index) in apiData.data.rows" :key="index">
                                    <tr>
                                        <td class="border px-4 py-2" x-text="row.id"></td>
                                        <td class="border px-4 py-2" x-text="row.fname"></td>
                                        <td class="border px-4 py-2" x-text="row.lname"></td>
                                        <td class="border px-4 py-2" x-text="row.email"></td>
                                        <td class="border px-4 py-2" x-text="new Date(row.date * 1000).toLocaleDateString()"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>  
                        <div class="mt-4">
                            <button @click="refreshData" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Refresh Data
                            </button>
                        </div> 
                       </div>
                       <p x-show="loading">Table is Loading...</p>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
