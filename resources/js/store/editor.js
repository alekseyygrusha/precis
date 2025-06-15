import { defineStore } from 'pinia';

export const useEditorStore = defineStore('editor', {
    state: () => ({
        cardMenu: false,
        blocksMenu: false,
        editBlockMenu: false,
        activeMenu: 'cardMenu',
        editBlockId: null
    }),
    getters: {
        isEditingBlock: (state) => (itemId) => {
            return itemId === state.editBlockId
        }
    },
    actions: {
        showBlocksMenu() {
            console.log('showBlocksMen');
            this.activeMenu = 'blocksMenu';
            this.editBlockId = null;
        },
        showCardMenu() {
            this.activeMenu = 'cardMenu';
        },
        showBlockEditMenu() {
            this.activeMenu = 'blockEditMenu';
        },
        startEditBlock(blockId) {
            this.editBlockId = blockId;
        },
    },
});
