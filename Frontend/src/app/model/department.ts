import { SchoolClass } from "./schoolclass";
import { User } from "./user";

export interface Department {
    id: number;
    name: string;
    budget: number;
    usedBudget: number;
    headOfDepartment: User;
    schoolClasses: SchoolClass[];
}
