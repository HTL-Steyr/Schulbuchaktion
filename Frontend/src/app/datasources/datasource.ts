import CustomStore from "devextreme/data/custom_store";
import DataSource from "devextreme/data/data_source";
import { firstValueFrom } from "rxjs";
import { FindAll } from "../service/findAll";

export class Datasource<T extends FindAll<any>> extends DataSource {
    constructor(private service: T, options: any = {}) {
        super(Object.assign({
            store: new CustomStore(Object.assign({
                load: () => {
                  return firstValueFrom(this.service.findAll());
                },
                remove: async (key: any) => {
                    return firstValueFrom(this.service.delete(key));
                },
                update: (id: number, data: T) => {
                  console.log(id);

                  return firstValueFrom(this.service.update(id, data));
                },
            }))
        }))
    }
}
