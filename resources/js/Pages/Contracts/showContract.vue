<script setup>
import CustomButton from '@/Components/CustomButton.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted  } from 'vue';
import manageContracts from './manageContracts.vue';


const contracts = ref([]);

const getContracts = async () => {
    try {
        const response = await axios.get('/contracts/all');
        contracts.value = response.data.contracts;
    } catch (error) {
        console.error(error);
    }
};

// Llamar a getContracts cuando el componente se monte
onMounted(() => {
    getContracts();
});

// Filtrar contratos
const filterStatus = ref('all'); // valor por defecto
const filteredContracts = computed(() => {
    if (filterStatus.value === 'all') {
        return contracts.value; // retornar todos los contratos
    }
    return contracts.value.filter(contract => contract.status === filterStatus.value); // retornar contratos filtrados
});

// Actualizar filtro
const filter = (status) => {
    filterStatus.value = status;
};

const showContract = (key) => {
    console.log(contracts.value[key]);
};
</script>

<template>
    <Head title="Contracts" />
        <DashboardLayout>
            <section class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-8 w-full justify-center items-center text-center pt-8">
              <nav class="col-span-2 block  rounded-lg p-2 h-[600px]">
                <div class="flex justify-between items-center p-2 text-grayt-200">
                    <h1 class="text-lg font-bold w-full flex">Contract</h1>
                </div>
                <manageContracts />
              </nav>
              <nav class="block bg-gray-100 rounded-lg shadow-lg p-2 h-[600px]">
                <div class="block justify-between items-center p-2">
                    <h1 class="text-lg font-bold w-full flex">Contracts</h1>
                    <nav class="flex justify-center text-sm w-full text-gray-500">
                        <button @click="filter('all')" class="p-2 flex justify-center text-center items-center group rounded-lg">
                            <i class="mdi mdi-circle pr-2 text-blue-700 group-hover:text-blue-500"></i>
                            <p class="text-xs font-bold text-blue-700 group-hover:text-black hover:underline underline-offset-2">All</p>
                        </button>
                        <button @click="filter('Active')" class="p-1 flex justify-center text-center items-center group rounded-lg">
                            <i class="mdi mdi-circle pr-2 text-green-700 group-hover:text-green-500"></i>
                            <p class="text-xs font-bold text-green-700 group-hover:text-black hover:underline underline-offset-2">Active</p>
                        </button>
                        <button @click="filter('Pending Renewal')" class="p-1 flex justify-center text-center items-center group rounded-lg">
                            <i class="mdi mdi-circle px-2 text-orange-800"></i>
                            <p class="text-xs font-bold text-yellow-700 group-hover:text-black hover:underline underline-offset-2">Pending Renewal</p>
                        </button>
                        <button @click="filter('Terminated')" class="p-2 flex justify-center text-center items-center group rounded-lg">
                            <i class="mdi mdi-circle p-2 text-red-500"></i>
                            <p class="text-xs font-bold text-red-500 group-hover:text-black hover:underline underline-offset-2">Terminated</p>
                        </button>
                    </nav>

                </div>
                <div class="block justify-center text-start p-2  overflow-y-auto h-[480px] ">
                    <div v-for="(contract, index) in filteredContracts" :key="contract.id" class="bg-white rounded-lg shadow-lg p-2 m-2">
                        <nav class="block sm:flex justify-between py-2">
                            <h1 class="text-sm text-wrap text-black font-black"> {{ contract.property_id }}</h1>
                            <div class="block">
                                <p :class="{
                                    'text-sm justify-end text-end items-end font-bold w-full px-4 rounded-md':true,
                                    'bg-gradient-to-l from-green-500 to-white from-10%': contract.status == 'Active',
                                    'bg-gradient-to-l from-yellow-500 to-white from-10%': contract.status == 'Pending Renewal',
                                    'bg-gradient-to-l from-red-500 to-white from-10%': contract.status == 'Terminated'
                                    }"> {{ contract.status }}</p>
                                <h1 class="text-sm text-pretty text-primary-black font-black"> {{ contract.rental_amount }}</h1>
                            </div>
                        </nav>
                       <div class="block sm:flex justify-start w-full items-center text-center"> <span class="text-sm font-bold text-start  px-2">Tenant:</span><p class="text-xs"> {{ contract.tenant_user_id }}</p></div>

                        <div class="grid grid-cols-3 md:grid-cols-3 gap-2 justify-center items-center text-center py-2">
                            <div class="items-center">
                                <CustomButton @click="showContract(contract.id)" :key="contract.id" class="">Details</CustomButton>
                            </div>
                            <div class="items-center">
                                <span class="text-sm font-bold text-start ">Being Date:</span><p class="text-xs"> {{ contract.start_date }}</p>
                            </div>
                            <div class="items-center">
                                <span class="text-sm font-bold text-start ">End Date:</span><p class="text-xs"> {{ contract.end_date }}</p>
                            </div>
                        </div>
                    </div>
                    <div :class="{
                        'w-full flex justify-center':true,
                        'hidden': filteredContracts.length > 0
                        }">
                        <i class="mdi mdi-loading text-4xl text-primary animate-spin"></i>
                    </div>
                </div>
              </nav>
            </section>
        </DashboardLayout>
</template>