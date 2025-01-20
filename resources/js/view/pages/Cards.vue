<template>
    <div class="container">
        <note-card :noteData="dataCards[0]">

        </note-card>
        <div class="note-card -shadow -small mt-5">
            <div class="note-item">
                <div class="heading-h1 px-4">Lorem ipsum dolor sit amet consectetur adipisicing.
                    Non, sunt!
                </div>
            </div>
            <div class="note-item">
                <p class="px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum
                    voluptates necessitatibus possimus. Lorem lorem
                    <mark>ipsum dolor</mark>
                    sit amet.
                </p>
            </div>
            <div class="note-item px-5">
                <p class="mb-2">Lorem ipsum dolor sit:</p>
                <ul>
                    <li>Lorem, ipsum dolor.</li>
                    <li>Lorem, ipsum.</li>
                    <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet consectetur.</li>
                </ul>
            </div>
            <div class="note-item px-4">
                <p>Lorem
                    <mark>ipsum dolor</mark>
                    sit amet, consectetur adipisicing elit. Excepturi sint eius voluptatem eos
                    alias veniam deserunt hic, suscipit quaerat impedit quisquam rem libero aut.
                </p>
            </div>
            <div class="note-item px-4 font-style-italic fst-italic text-decoration-underline">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="px-4 card-number pb-4 text-end">1</div>
        </div>
    </div>
</template>

<script>
    import NoteCard from "@/view/note/NoteCard.vue";

    export default {
        name: 'Cards',
        data () {
            return {
                dataCards: {
                    0: {
                        id: 1,
                        name: '',
                        items: {
                            0: {
                                id: 1,
                                type: 'heading',
                                content: 'Lorem ipsum dolor sit amet consectetur adipisicing. Non, sunt!',
                                classes: ['heading-h1'],
                                defaultClasses: ['px-4'] //будем только при создании их добавлять
                            },
                            1: {
                                id: 2,
                                type: 'text',
                                content: `Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum
                    voluptates necessitatibus possimus. Lorem lorem
                    <mark>ipsum dolor</mark>
                    sit amet.`,
                                classes: ['123'],
                                defaultClasses: ['px-4']
                            },

                        },
                        questions: {}
                    },
                    1: {

                    }
                },
            }
        },

        components: {NoteCard}
    }
</script>
