<template>
    <div class="dash-dailog">
        <div class="dash-dailog-box">
            <div class="title">{{ notification.title }}</div>
            <p class="description thanks">
                {{ notification.body }}
            </p>
            <div class="dailog-buttons-actions">
                <button @click="closePopup" class="back-conversation">OK</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        console.log(this.notification);
    },
    props: {
        notification: {
            type: Object,
            required: true
        }
    },
    methods: {
        closePopup() {
            this.$emit('close');
        }
    }
}
</script>

<style scoped>
.dash-dailog {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(201, 201, 201, 20%);
    z-index: 100;
    display: flex;
    justify-content: center;
    align-items: center;
}

.dash-dailog .dash-dailog-box {
    background: #fff;
    border-radius: 20px;
    padding: 20px 30px;
    min-width: 750px;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.dash-dailog .dash-dailog-box>*:not(:last-child),
.dash-form>*:not(:last-child) {
    margin-bottom: 15px;
}

.dash-dailog .icon {
    max-width: 70px;
}

.dash-dailog .icon img {
    max-width: 100%;
    display: block;
    margin: auto;
}

.dash-dailog .title {
    font-size: 18px;
    color: #040506;
    font-weight: bold;
}

.dash-dailog .description {
    font-size: 16px;
    color: #c9c9c9;
    text-align: center;
    border: 1px solid rgba(157, 157, 157, 23%);
    border-radius: 5px;
    padding: 10px;
    width: 100%;
}

.dash-dailog .description.thanks {
    max-width: 520px;
}

.dash-dailog .dash-form {
    width: 100%;
}

.dash-form textarea,
.dash-form input,
.dash-form select {
    color: rgba(157, 157, 157, 23%);
    padding: 14px 30px;
    border: 1px solid rgba(157, 157, 157, 23%);
    border-radius: 5px;
    display: block;
    width: 100%;
    font-size: 20px;
}

.dash-form textarea {
    min-height: 160px;
}

.dash-form button[type="submit"],
.dash-form input[type="submit"] {
    width: 100%;
    padding: 16px;
    border-radius: 5px;
    background-color: #4e1b56;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    border: none;
}

button.files-uploader {
    width: 100%;
    padding: 16px;
    border-radius: 5px;
    background-color: rgba(201, 201, 201, 23%);
    cursor: pointer;
    border: none;
}

button.files-uploader img {
    width: 24px;
}

.dash-form button[type="submit"].pelorous,
.dash-form input[type="submit"].pelorous {
    background-color: #3eadb7;
}

.dailog-buttons-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    width: 25%;
    flex-wrap: wrap;
}

.dailog-buttons-actions button {
    padding: 8px;
    text-align: center;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    border: none;
    width: calc(50% - (15px / 2));
    flex-grow: 1;
}

.dailog-buttons-actions button.ending {
    background-color: #fb5b5b;
}

.dailog-buttons-actions button.back-conversation {
    background-color: #3eadb7;
}

@media (max-width: 800px) {
    .dash-dailog .dash-dailog-box {
        min-width: calc(100% - 20px);
        padding: 40px 10px;
    }

    .dash-dailog .title {
        font-size: 22px;
    }

    .dash-dailog .description,
    .dash-form textarea,
    .dash-form input,
    .dash-form select {
        font-size: 18px;
    }
}

@media (max-width: 500px) {
    .dash-dailog .icon {
        max-width: 50px;
    }

    .dailog-buttons-actions button {
        width: 100%;
    }
}</style>
