<template>
    <div class="questions-block">
        <template v-for="(question, key) in questionsList">
            <template v-if="activeIndex == key">
                <div class="quesion-text">{{question.question}}</div>
                <div class="text-hint">
                    <transition name="fade">
                        <div v-if="question.questionHint">{{question.questionHint}}</div>
                    </transition>
                </div>

                <div class="questions-list">
                    <div class="question-item"  v-for="(item, itemKey) in question.items"  :key="item.id" :class="[item.id === errorId ? 'shake' : '', item.id === correctId ? '-success' : '']" @click="checkCorrectAnswer(item.id)" >{{ item.question }}</div>
                </div>

            </template>

        </template>
        <div class="buttons-bar">
            <button class="btn -base">Закрыть</button>
            <button class="btn -base">Следующий</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'QuestionItem',
        data() {
            return {
                errorId: '',
                correctId: '',
                activeIndex: 0,
                questionHint: '',
                questionsList: {
                    0: {
                        question: 'что? где? когда??',

                        items: [
                            {
                                id: 1,
                                question: 'то, там, тогда',
                                hint: 'Верно!'
                            },
                            {
                                id: 2,
                                question: 'Вариант ответа 1',
                                hint: 'Ещё надо подумать 1'
                            },
                            {
                                id: 3,
                                question: 'Вариант ответа 2',
                                hint: 'Ещё надо подумать 2'
                            },
                            {
                                id: 4,
                                question: 'Вариант ответа 3',
                                hint: 'Ещё надо подумать 3'
                            }
                        ],
                        correct: 1
                    },
                    1: {
                        question: 'Новый глупый вопрос',
                        questionHint: '',
                        items: [
                            {
                                id: 1,
                                question: 'то, там, тогда',
                                hint: 'Верно!'
                            },
                            {
                                id: 2,
                                question: 'Вариант ответа 1',
                                hint: 'Ещё надо подумать 1'
                            },
                            {
                                id: 3,
                                question: 'Вариант ответа 2',
                                hint: 'Ещё надо подумать 2'
                            },
                            {
                                id: 4,
                                question: 'Вариант ответа 3',
                                hint: 'Ещё надо подумать 3'
                            }
                        ],
                        correct: 1
                    }
                }
            }
        },
        methods: {
            checkCorrectAnswer(id) {
                this.questionHint = false;
                this.errorId = '';
                this.correctId = '';
                let isCorrect = this.questionsList[this.activeIndex].correct === id;
                let questionItem = this.questionsList[this.activeIndex].items.find(qi => qi.id === id);


                if(isCorrect) {
                    this.setCorrect(questionItem, id);
                } else {
                    this.setNotCorrect(questionItem, id);
                }

                this.questionHint = questionItem.hint;
            },
            setCorrect(questionItem, id) {
                this.correctId = id;
            },
            setNotCorrect(questionItem, id) {
                this.errorId = id;
            }
        }
    }
</script>
