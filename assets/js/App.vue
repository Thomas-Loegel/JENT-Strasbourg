<template>
    <div>
        <h1>Je suis dans VueJs</h1>
        <button @click="toto">Click me {{counter}}</button>
    </div>
</template>

<script>
    export default {
        data: () => ({
            counter: 0,
            data: []
        }),

        methods: {
            greet: function (event) {

                // `this` inside methods point to the Vue instance
                alert('Hello ' + this.name + '!')

                // `event` is the native DOM event
                alert(event.target.tagName)
            },

            toto: function () {
                alert('hello toto!')
            }
        }
    }
</script>

<style scoped>

</style>