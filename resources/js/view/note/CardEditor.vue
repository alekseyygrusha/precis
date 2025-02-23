<template>
    <div>
        <div class="card-editor-menu">
            <transition name="fade" mode="out-in">
                <div class="menu-wrap" v-if="!isShowBlocksMenu">
                    <div class="menu-item"  @click="showBlocksMenu">
                        <div class="icon">
                            <SvgIcon name="add"></SvgIcon>
                        </div>
                        <div class="annotation">Новый блок</div>
                    </div>
                    <div class="menu-item"  @click="deleteCard">
                        <div class="icon">
                            <SvgIcon name="delete"></SvgIcon>
                        </div>
                        <div class="annotation">Удалить</div>
                    </div>
                </div>

                <div class="menu-wrap" v-else>
                    <div class="menu-item -visible" @click="goPrevMenu">
                        <div class="icon">
                            <SvgIcon name="back"></SvgIcon>
                        </div>
                        <div class="annotation ">Вернуться</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('heading')">
                        <div class="icon">
                            <SvgIcon name="heading"></SvgIcon>
                        </div>
                        <div class="annotation">Параграф</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('text')">
                        <div class="icon">
                            <SvgIcon name="text"></SvgIcon>
                        </div>
                        <div class="annotation">Параграф</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('list')">
                        <div class="icon">
                            <SvgIcon name="list2"></SvgIcon>
                        </div>
                        <div class="annotation">Список</div>
                    </div>
                    <div class="menu-item" @click="addCardBlock('code')">
                        <div class="icon">
                            <SvgIcon name="code2"></SvgIcon>
                        </div>
                        <div class="annotation">Код</div>
                    </div>
                </div>
            </transition>

        </div>
        <div class="note-card -shadow -small mb-4">
            <transition-group name="fade">
                <template v-for="noteItem in noteData.items" :key="noteItem.id">
                        <NoteItemEditor :itemData="noteItem" :noteId="noteItem.id" ></NoteItemEditor>
                </template>
            </transition-group>


            <div class="-sriracha-font px-4 card-number pb-4 text-end"></div>
        </div>
    </div>

</template>

<script>
import NoteItem from "@/view/note/noteItems/NoteItem.vue";
import SvgIcon from "@/customElements/SvgIcon.vue";
import ids from 'virtual:svg-icons-names'
import {useCardsStore} from "@/store/cards.js";
import {mapStores} from "pinia";
import NoteItemEditor from "@/view/note/noteItemsEditor/NoteItemEditor.vue";

const cardsStore = useCardsStore();

const blockItems = cardsStore.blocks;
export default {
    name: 'CardEditor',
    components: {NoteItemEditor, SvgIcon, NoteItem},
    props: {
        id: {
            type: Number,

        },
        noteData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isShowBlocksMenu: false
        };
    },
    created() {

    },
    methods: {
        addCardBlock(blockType) {
            let newBlock = blockItems[blockType];
            cardsStore.addBlockToCard(this.id, newBlock)
            console.log('newBlock', newBlock);
        },
        goPrevMenu() {
            this.isShowBlocksMenu = false;
        },
        showBlocksMenu() {
            this.isShowBlocksMenu = true;
        },
        deleteCard() {

        }
    },
    computed: {
        ...mapStores(cardsStore)

        /*calcCadsCount() {
            return Object.keys(this.noteData).length
        }*/
    }

}
</script>
