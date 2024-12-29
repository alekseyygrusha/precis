import { defineStore } from 'pinia';


export const useRootStore = defineStore('root', {
    state: () => ({
        testList: [
            {
                id: 1
            },
            {
                id: 2
            },
            {
                id: 3
            },
            {
                id: 4
            },
        ]
    }),
    actions: {

    },
});
