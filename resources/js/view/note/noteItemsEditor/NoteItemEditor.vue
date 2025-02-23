<template>
    <div class="note-item">
        <component :is="componentName" :isEdit="true" :noteId="noteId" :itemData="itemData" :classes="setClasses"></component>
    </div>
</template>

<script>
import HeadingItem from "@/view/note/noteItems/HeadingItem.vue";
import TextItem from "@/view/note/noteItems/TextItem.vue";
import ListItem from "@/view/note/noteItems/ListItem.vue";
import CodeExampleItem from "@/view/note/noteItems/CodeExampleItem.vue";
export default {
    name: 'NoteItemEditor',
    data() {
        return {

        };
    },
    components: {
        HeadingItem,TextItem, ListItem, CodeExampleItem
    },
    props: {

        noteId: {
            required: true,
            type: Number
        },
        itemData: {
            required: true,
            type: Object
        }
    },
    computed: {
        componentName() {
            return `${this.itemData.type.charAt(0).toUpperCase() + this.itemData.type.slice(1)}Item`
        },
        setClasses() {
            return this.itemData?.defaultClasses.join(" ") + ' ' + this.itemData?.classes.join(" ");
        }

    },
    watch: {

    },
    created() {

    },
    mounted() {

    },
};
</script>

<style>

</style>
