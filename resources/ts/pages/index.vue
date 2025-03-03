<script lang="ts" setup>
import { onBeforeMount, ref } from "vue";
import { useDisplay } from "vuetify";
import type { User } from "@/types/index";
import UsersOverview from "@/components/UsersOverview.vue";
import { useServices } from "@/services";
import { useError } from "@/composables";

const $services = useServices();
const { smAndDown } = useDisplay();

const form = ref<User>({
    name: "",
    last_name: "",
    age: 0,
    gender: "",
    email: "",
});

const users = ref<User[]>([]);

async function submit() {
    const { data } = await $services.create(form.value);
    users.value.push(data.data);

    form.value = {
        name: "",
        last_name: "",
        age: 0,
        gender: "",
        email: "",
    };
}

async function getUsers() {
    try {
        const { data } = await $services.list();
        data.data.forEach(async (d) => {
            users.value.push({
                ...d,
                country: (await getCountry(d))?.country_id,
            });
        });
    } catch (error) {
        useError(error);
    }
}

async function getCountry(user: User) {
    try {
        const { data } = await $services.getCountry(user.name);

        return data.country[0];
    } catch (error) {
        useError(error);
    }
}

onBeforeMount(() => {
    getUsers();
});
</script>

<template>
    <div class="pa-4">
        <v-card class="mx-auto" width="400">
            <template #title>
                <span class="font-weight-black">Añadir usuario</span>
            </template>

            <v-card-text class="bg-surface-light pt-4">
                <form style="max-" @submit.prevent="submit">
                    <v-text-field
                        v-model="form.name"
                        label="Nombre"
                        type="text"
                    />

                    <v-text-field
                        v-model="form.last_name"
                        label="Apellido"
                        type="text"
                    />

                    <v-text-field
                        v-model="form.age"
                        label="Edad"
                        type="number"
                    />

                    <v-text-field
                        v-model="form.email"
                        type="mail"
                        label="Correo"
                    />

                    <v-select
                        v-model="form.gender"
                        :items="['Masculino', 'Femenino']"
                        label="Select"
                    />

                    <v-btn class="me-4" type="submit"> Enviar </v-btn>
                </form>
            </v-card-text>
        </v-card>

        <div
            class="mt-4 d-flex w-100 flex-wrap flex-sm-nowrap justify-space-between"
        >
            <v-table>
                <thead>
                    <tr>
                        <th class="text-left">Nombre</th>
                        <th v-show="!smAndDown" class="text-left">Apellidos</th>
                        <th v-show="!smAndDown" class="text-left">Edad</th>
                        <th class="text-left">Género</th>
                        <th class="text-left">Correo</th>
                        <th class="text-left">Pais</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.name">
                        <td>{{ user.name }}</td>
                        <td v-show="!smAndDown">
                            {{ user.last_name }}
                        </td>
                        <td v-show="!smAndDown">
                            {{ user.age }}
                        </td>
                        <td>{{ user.gender }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.country }}</td>
                    </tr>
                </tbody>
            </v-table>

            <UsersOverview :users="users" style="min-width: 40rem" />
        </div>
    </div>
</template>
