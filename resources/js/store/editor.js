import { defineStore } from 'pinia';

export const useEditorStore = defineStore('editor', {
    state: () => ({
        cardMenu: false,
        blocksMenu: false,
        editBlockMenu: false,
        activeMenu: 'cardMenu',
    })
});
