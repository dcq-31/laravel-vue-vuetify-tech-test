import type {
    UserWrapper,
    UserCreate,
    User,
    UserUpdate,
    NationalizeCountry,
} from "@/types";
import axios from "axios";

const api = axios.create({
    baseURL: "http://localhost:8000",
    withCredentials: true,
});

export function useServices() {
    const baseUrl = "/api/users";
    return {
        create: (params: UserCreate) => api.post<UserWrapper>(baseUrl, params),
        list: () => api.get<UserWrapper<User[]>>(baseUrl),
        update: (id: number, params: UserUpdate) =>
            api.patch<UserWrapper<User[]>>(`${baseUrl}/${id}`, params),
        getCountry: (name: string) =>
            axios.get<NationalizeCountry>(
                `https://api.nationalize.io/?name=${name}`
            ),
    };
}
