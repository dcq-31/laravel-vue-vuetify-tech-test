<script lang="ts" setup>
import { computed } from "vue";
import type { User } from "@/types/index";

const props = defineProps<{ users: User[] }>();

const averageAge = computed(() => {
    if (props.users.length === 0) return 0;
    const totalAge = props.users.reduce((sum, user) => sum + user.age, 0);
    return (totalAge / props.users.length).toFixed(2);
});

const totalMales = computed(
    () => props.users.filter((user) => user.gender === "Masculino").length
);
const totalFemales = computed(
    () => props.users.filter((user) => user.gender === "Femenino").length
);

const youngestPerson = computed(() =>
    props.users.reduce(
        (min, user) => (user.age < min.age ? user : min),
        props.users[0]
    )
);
const oldestPerson = computed(() =>
    props.users.reduce(
        (max, user) => (user.age > max.age ? user : max),
        props.users[0]
    )
);
</script>

<template>
    <v-container>
        <v-card>
            <v-card-title>Información del usuario</v-card-title>
            <v-card-text>
                <v-row>
                    <v-col>
                        <v-alert variant="outlined" type="info">
                            <strong>Edad Promedio:</strong>
                            {{ averageAge }} años
                        </v-alert>
                    </v-col>
                    <v-col>
                        <v-alert variant="outlined" type="info">
                            <strong>Total de Masculinos:</strong>
                            {{ totalMales }}
                        </v-alert>
                    </v-col>
                    <v-col>
                        <v-alert variant="outlined" type="info">
                            <strong>Total Femenino:</strong> {{ totalFemales }}
                        </v-alert>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-alert variant="outlined" type="success">
                            <strong>Persona más joven:</strong>
                            {{ youngestPerson?.name }} ({{
                                youngestPerson?.age
                            }}
                            años)
                        </v-alert>
                    </v-col>
                    <v-col>
                        <v-alert variant="outlined" type="warning">
                            <strong>Persona más vieja:</strong>
                            {{ oldestPerson?.name }} ({{ oldestPerson?.age }}
                            años)
                        </v-alert>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>
