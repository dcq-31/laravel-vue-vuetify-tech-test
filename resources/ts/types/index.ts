export interface User {
    name: string;
    last_name: string;
    age: number;
    gender: string;
    email: string;
    country?: string;
}

export type UserCreate = User;
export type UserUpdate = Partial<UserCreate>;
export interface UserWrapper<T = User> {
    data: T;
}

export interface NationalizeCountry {
    count: number;
    name: string;
    country: [{ country_id: string; probability: number }];
}
