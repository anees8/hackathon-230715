<template>
  <b-container fluid>
    <b-row>
      <b-card>
        <b-col>
          <b-row align-v="center">
            <b-col><h5>Sizes List</h5></b-col>
            <b-col>
              <b-button
              size="sm"
                @click="modal = !modal"
                class="float-end"
                pill
                variant="outline-dark"
              >
                <FontAwesomeIcon icon="plus" class="me-2" />Add Size</b-button
              >
              <div>
                <b-modal
                  v-model="modal"
                  :title="size.id ? 'Update Size' : 'Add Size'"
                  hide-header-close
                  no-close-on-backdrop
                >
                  <BFormGroup
                    id="input-group-1"
                    label="Size Name:"
                    label-for="input-1"
                  >
                    <BFormInput
                      id="input-1"
                      v-model="size.name"
                      :class="errors && errors.name ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="text"
                      placeholder="Enter Size Name"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.name">{{
                      errors.name[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>

                  <template #footer>
                    <div>
                      <button class="btn btn-outline-dark" @click="hideModel">
                        Close
                      </button>
                    </div>
                    <div>
                      <button
                        class="btn btn-outline-primary"
                        @click="uploadData"
                      >
                        {{ size.id ? "Update Size" : "Add Size" }}
                      </button>
                    </div>
                  </template>
                </b-modal>
              </div></b-col
            >
          </b-row>
        </b-col>
        <b-col
          ><b-table
            striped
            outlined
            empty-filtered-text
            caption-top
            hover
            small
            footClone
            :items="sizes"
            :fields="fields"
            :busy="isBusy"
            responsive
            show-empty
          >
            <template #cell(created_at)="data">{{
              dateTime(data.value)
            }}</template>
            <template #cell(actions)="data">
              <b-button
              size="sm"
                class="rounded-circle p-2 me-2"
                @click="editSize(data.item.id)"
                variant="outline-success"
              >
                <FontAwesomeIcon icon="pen" />
              </b-button>

              <b-button
              size="sm"
                class="rounded-circle p-2 me-2"
                @click="deleteSize(data.item.id)"
                variant="outline-danger"
              >
                <FontAwesomeIcon icon="fa-regular fa-trash-alt" />
              </b-button>
            </template> </b-table
        ></b-col>
      </b-card>
    </b-row>
  </b-container>
</template>
<script setup>
import { storeToRefs } from "pinia";

import { useSizesStore } from "../stores/sizes.js";
const { sizes, size, fields, modal, isBusy, errors } = storeToRefs(
  useSizesStore()
);

const { getSizes, dateTime, uploadData, editSize, deleteSize, hideModel } =
  useSizesStore();

getSizes();
</script>
