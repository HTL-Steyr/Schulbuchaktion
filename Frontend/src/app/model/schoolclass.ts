export interface SchoolClass {
  id: number;
  name: string;
  grade: number;
  studentAmount: number;
  repAmount: number;
  usedBudget: number;
  budget: number;
  year: number;
  schoolForm: number;
  departmentId: Department;
  bookOrders: Collection;

}
