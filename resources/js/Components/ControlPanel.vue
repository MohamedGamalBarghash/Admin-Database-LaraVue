<template>
    <div v-for="(key, index) in emps" class="text-left w-full flex flex-row p-1 bg-white border-2">
        <!-- <div class="text-center flex m-auto align-middle w-1/12" v-if="index>0"><img :src='key["image"]' /></div> -->
        <div class="theDivs text-center flex m-auto align-middle w-1/12" v-if="index>=0" v-html="key['image']"></div>
        <div class="theDivs text-left flex m-auto align-middle border-l-2 px-2" v-html="key['name']"></div>
        <div class="theDivs text-left flex m-auto align-middle border-l-2 px-2" v-html="key['email']"></div>
        <div class="theDivs text-left flex m-auto align-middle border-l-2 px-2" v-html="key['phone']"></div>
        <div class="theDivs text-left flex m-auto align-middle border-l-2 px-2" v-html="key['dependant']"></div>
        <div class="theDivs text-left flex m-auto align-middle border-l-2 px-2" v-html="key['age']"></div>
        <div class="theDivs text-left flex m-auto align-middle border-l-2 px-2" v-html="key['department']"></div>
        <div @click="index>0 ? ShowModal(index-1) : null" class="flex m-auto align-middle border-l-2 justify-center">
            <span v-if="index>0" class="material-symbols-outlined">
                edit
            </span>
            <span v-if="index==0" class="text-white material-symbols-outlined">
                edit
            </span>
        </div>
        <div @click="index>0 ? DeleteEntry(index-1) : null" class="flex m-auto align-middle border-l-2 justify-center">
            <span v-if="index>0" class="material-symbols-outlined">
                delete
            </span>
            <span v-if="index==0" class="text-white material-symbols-outlined">
                delete
            </span>
        </div>
    </div>
    <Modal :myTitle="theTitle" :theId="modalID" :theType="modalType" :theData="theDataControl" v-if="showModal"
        @close="showModal = false" />
</template>

<script>
import Modal from './Modal.vue'

export default {
    name: "ControlPanel",
    components: [
        Modal
    ],
    data() {
        return {
            theTitle: 'Edit this entry',
            emps: [],
            modalID: null,
            showModal: false,
            modalType: "Edit"
        };
    },
    props: ["theDataControl"],
    methods: {
        ShowModal(theIndex) {
            this.modalID = theIndex
            this.showModal = true
        },
        DeleteEntry(theIndex) {
            axios.delete('/api/employees/delete/' + this.theDataControl[theIndex]['id']).then((response) => {
                console.log(response)
            }).catch((errors) => {
                console.log(errors)
            }).finally(() => {
                alert('Entry deleted successfully!')
                window.location.reload()
            })
        }
    },
    beforeUpdate() {
        this.emps = [{
            "image": "<b>Image</b>",
            "name": "<b>Name</b>",
            "email": "<b>Email</b>",
            "phone": "<b>Phone</b>",
            "dependant": "<b>Dependant</b>",
            "age": "<b>Age</b>",
            "department": "<b>Department</b>"
        }];
        for (let key of this.theDataControl) {
            this.emps.push(key);
        }
    },
    components: { Modal }
}
</script>

<style scoped>
.theDivs {
    /* text-overflow: ellipsis; */
    width: 12.5%;
    /* white-space: nowrap; */
    overflow: hidden;
    vertical-align: top;
}
</style>