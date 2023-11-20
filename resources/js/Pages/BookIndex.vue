<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Books from "@/Pages/Books.vue";

defineProps(['books']);
</script>

<template>
    <Head title="Livros"/>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Livros disponiveis</h2>
        </template>

        <div class="flex gap-10 flex-wrap p-3 justify-center">
            <Books
                v-for="(book,index) in books"
                :key="index"
                :book="book"
            />
        </div>

    </AuthenticatedLayout>
</template>
