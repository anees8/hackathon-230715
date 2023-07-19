<template>
  <b-container fluid>
    <b-row>
      <b-card>
        <b-col>
          <b-row align-v="center">
            <b-col><h5>SKUS List</h5></b-col>
            <b-col>
              <b-button
                @click="modal = !modal"
                class="float-end"
                pill
                variant="outline-dark"
              >
                <FontAwesomeIcon icon="plus" class="me-2" />Add SKU</b-button
              >
              <div>
                <b-modal
                  v-model="modal"
                  :title="sku.id ? 'Update SKU' : 'Add SKU'"
                  hide-header-close
                  no-close-on-backdrop
                >
                  <BFormGroup
                    id="input-group-1"
                    label="Sku Code:"
                    label-for="input-1"
                  >
                    <BFormInput
                      id="input-1"
                      v-model="sku.name"
                      :class="errors && errors.name ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="text"
                      placeholder="Enter SKU Code"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.name">{{
                      errors.name[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>
                  <BFormGroup
                    id="input-group-2"
                    label="Price:"
                    label-for="input-2"
                  >
                    <BFormInput
                      id="input-2"
                      v-model="sku.price"
                      :class="errors && errors.price ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                      type="number"
                      placeholder="Enter Price"
                    />
                    <BFormInvalidFeedback v-if="errors && errors.price">{{
                      errors.price[0]
                    }}</BFormInvalidFeedback>
                  </BFormGroup>

                  <BFormGroup
                    id="input-group-3"
                    label="Size:"
                    label-for="input-3"
                  >
                    <BFormSelect
                      v-model="sku.size_id"
                      :class="errors && errors.size_id ? 'is-invalid' : ''"
                      :disabled="!isBusy ? false : true"
                    >
                      <BFormSelectOption disabled   value="">Please select an option</BFormSelectOption>

                      <BFormSelectOption
                        v-for="(size, index) in sizes"
                        :key="index"
                        :value="size.id"
                        >{{ size.name }}</BFormSelectOption
                      >
                    </BFormSelect>
                    <BFormInvalidFeedback v-if="errors && errors.size_id">{{
                      errors.size_id[0]
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
                        {{ sku.id ? "Update SKU" : "Add SKU" }}
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
            footClone
            :items="skus"
            :fields="fields"
            :busy="isBusy"
            responsive
            show-empty
          >
            <template #cell(size)="data">{{ data.item.size.name }}</template>
            <template #cell(created_at)="data">{{
              dateTime(data.item.created_at)
            }}</template>
            <template #cell(actions)="data">
              <b-button
                class="rounded-circle p-2 me-2"
                @click="editSku(data.item.id)"
                variant="outline-success"
              >
                <FontAwesomeIcon icon="pen" />
              </b-button>

              <b-button
                class="rounded-circle p-2 me-2"
                @click="deleteSku(data.item.id)"
                variant="outline-danger"
              >
                <FontAwesomeIcon icon="fa-regular fa-trash-alt" />
              </b-button>
            </template> </b-table
        ></b-col>
        <b-row align-h="end" class="mt-5">
          <b-col xl="1" lg="2" md="2" class="p-2">
            <b-form-select
              v-if="rows > 5"
              v-model="perPage"
              :options="options"
              size="md"
              v-on:change="setPerPage"
              varient="dark"
            ></b-form-select>
          </b-col>
          <b-col xl="5" lg="6" md="8" class="p-2">
            <b-pagination
              v-if="rows / perPage > 1"
              v-on:click="getSkus"
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
            ></b-pagination>
          </b-col>
        </b-row>
      </b-card>
    </b-row>
  </b-container>
</template>
<script setup>
import { storeToRefs } from "pinia";
import { useSkusStore } from "../stores/skus.js";
import { useSizesStore } from "../stores/sizes.js";
const {
  skus,
  sku,
  fields,
  modal,
  isBusy,
  errors,
  options,
  perPage,
  currentPage,
  rows
} = storeToRefs(useSkusStore());
const { sizes } = storeToRefs(useSizesStore());

const { getSizes } = useSizesStore();

const {
  getSkus,
  setPerPage,
  dateTime,
  uploadData,
  editSku,
  deleteSku,
  hideModel
} = useSkusStore();

getSkus();

getSizes();
</script>
