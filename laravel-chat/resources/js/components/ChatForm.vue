<template>
    <div class="input-group">
        <input 
        type="text" 
        class="form-control input-sm"
        v-model="newMessage"
        @keyup.enter="sendMessage"
        >
        
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            newMessage: "",
        }
    },
    methods: {
        sendMessage(){
            this.$emit("messagesent", {
                user: this.user,
                message: this.newMessage
            })
            this.newMessage = ""
        }
    }
}
</script>