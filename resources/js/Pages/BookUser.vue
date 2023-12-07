<script setup>

import CancelSvg from "@/Components/CancelSvg.vue";
import ModalSucess from "@/Components/ModalSucess.vue";

defineProps(['book'])
</script>

<template>

    <div class="max-w-sm">
        <div class="w-52">
            <img :src="book.image" :alt="book.title" class="w-48" />
            <h4 class="uppercase flex flex-wrap text-sm">{{ book.title }}</h4>
            <p class="mb-3 text-gray-400 font-light text-sm">{{ book.author }}</p>
            <div class="flex justify-between gap-5">
                <a v-if="book.status === 'awaiting withdrawal'"
                   class=" px-2 py-1 bg-amber-300 rounded-lg justify-start text-white text-center">
                    Aguardando Retirada
                </a>
                <a v-if="book.status === 'cancel'" class=" px-4 py-2 bg-red-600 rounded-lg justify-start text-white">
                    Cancelado
                </a>
                <a v-if="book.status === 'withdrawn'" class=" px-4 py-2 bg-green-400 rounded-lg justify-start text-white">
                    Retirado
                </a>
                    <a class=" px-4 py-2 bg-red-500 rounded-lg justify-start text-white" :href="route('rent-book.destroy',book.id)">
                        <CancelSvg></CancelSvg>
                    </a>
            </div>
        </div>
    </div>

</template>
