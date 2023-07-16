<script setup>
import { storeToRefs } from "pinia";
import { useLoginStore } from "@/stores/login.js";
const { user, errors, loading } = storeToRefs(useLoginStore());
const { login, resetForm } = useLoginStore();

resetForm();
</script>
<template>
    <BContainer fluid>
        <BRow class="align-items-center justify-content-center vh-100">
            <BCol cols="12" lg="4" md="6">
                <BCard>
                    <BCol cols="12" class="text-center">
                        <h3>UBER <h6>for Tailors</h6></h3> 
                    </BCol>
                    <BCol cols="12">
                        <span v-if="errors.error" class="text-danger text-center">{{ errors.error }}</span>
                        <BForm @submit="login" @reset="resetForm">
                            <BFormGroup class="mt-2" id="input-group-1" label="Email address:" label-for="input-1"
                              >
                                <BFormInput  id="input-1" v-model="user.email" :class="errors.email ? 'is-invalid' : ''" :disabled="!loading ? false : true" type="email" placeholder="Enter email"
                                     />
                                     <BFormInvalidFeedback v-if="errors.email">{{ errors.email[0] }}</BFormInvalidFeedback>

                            </BFormGroup>
                            <BFormGroup class="my-2" id="input-group-2" label="Password:" label-for="input-2">
                            <BFormInput id="input-2" v-model="user.password" :class="errors.password ? 'is-invalid' : ''" :disabled="!loading ? false : true"  placeholder="Enter Password" />
                            <BFormInvalidFeedback v-if="errors.password">{{ errors.password[0] }}</BFormInvalidFeedback>
                            </BFormGroup>

                            <BButton  class="me-2"  type="submit" variant="primary">
                                 <span v-if="!loading">Login</span>
                                 <FontAwesomeIcon v-if="!loading" class="ms-2" icon="arrow-right" />
                                 <BSpinner class="me-1" v-if="loading" small></BSpinner>
                              <span v-if="loading">Login...</span></BButton>
                            <BButton type="reset" variant="danger">Reset</BButton>
                        </BForm>
                    </BCol>
                </BCard>
            </BCol>
        </BRow>
    </BContainer>
</template>