<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


const form = useForm({
    password: "",
    password_confirmation: ''
});

const props = defineProps({
    details: Array
})

const submit = () => {
    form.family_name = props.details['family_name']
    form.email = props.details['email']
    form.post(route('check-join-step-2'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>
    <Head title="Join a Family" />
    <BreezeGuestLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Join A Family
            </h2>
        </template>

        <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">

            <div class="mt-4">
                <BreezeLabel for="password" value="New Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autofocus autocomplete="password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="password_confirmation" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <BreezeButton class="btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Join
                </BreezeButton>
            </div>
            <!-- <Link :href="route('welcome')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Back to Login
            </Link> -->
        </form>
        </div>
        </div>
        </div>
    </BreezeGuestLayout>
</template>
