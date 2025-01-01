<template>
    <div class="questions-block">
        <div class="quesion-text">что? где? когда??</div>
        <div class="text-hint">{{questionsList.questionHint}}</div>
        <div class="questions-list">
            <div class="question-item" @click="checkCorrectAnswer(item.id)" v-for="item in questionsList.items">{{ item.question }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'QuestionItem',
        data() {
            return {
                questionsList: {
                    questionHint: '',
                    items: [
                        {
                            id: 1,
                            question: 'то, там, тогда',
                            hint: 'точно!'
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
        },
        methods: {
            checkCorrectAnswer(id) {
                let isCorrect = this.questionsList.correct === id;
                let questionItem = this.questionsList.items.find(qi => qi.id === id);

                console.log('questionItem', questionItem);
                if(isCorrect) {
                    this.setCorrect(questionItem);
                } else {
                    this.setNotCorrect(questionItem);
                }
            },
            setCorrect(questionItem) {
                this.questionsList.questionHint = questionItem.hint;
            },
            setNotCorrect(questionItem) {
                this.questionsList.questionHint = questionItem.hint;
            }
        }
    }
</script>