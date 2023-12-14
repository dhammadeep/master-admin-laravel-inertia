<template>
	<div class="formContainer">
		<form method="post" enctype="multipart/form-data" novalidate @submit.prevent="submit($event)">
			<div class="formTitleContainer d-flex justify-content-between align-items-center border-bottom">
				<h5 class="formTitle m-0">Table Field Metadata Generator</h5>
			</div>
			<div class="accordion">
				<div class="customCard" v-for="(column, position) in cols" :key="column.COLUMN_NAME">
					<div class="customCardTitleContainer d-flex justify-content-between align-item-center" data-bs-toggle="collapse" :data-bs-target="`#${column.COLUMN_NAME}`" aria-expanded="false" @click="toggleDisabled(`${column.COLUMN_NAME}`)">
						<h6 class="customCardTitle">{{ column.COLUMN_NAME }}</h6>
						<!-- <button type="button" class="btn btn-primary btn-sm">{{ column.disabled ? "Enable" : "Disable" }}</button> -->
						<span class="icon">
							<i class="fa-solid fa-angle-down"></i>
						</span>
					</div>
					<div :id="`${column.COLUMN_NAME}`" class="collapse">
						<div class="row accordion-body">
							<!-- First Column -->
							<div class="col-12 col-sm-12 col-md-12 col-lg">
								<!-- Position -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[position]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Position: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<input type="text" class="form-control" :disabled="column.disabled" :value="position" :name="`${column.COLUMN_NAME}[position]`" :id="`${column.COLUMN_NAME}[position]`" placeholder="Enter Position" />
									</div>
								</div>
								<!-- Name -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[name]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Name: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<input type="text" class="form-control" :disabled="column.disabled" :value="column.COLUMN_NAME" :name="`${column.COLUMN_NAME}[name]`" :id="`${column.COLUMN_NAME}[name]`" placeholder="Enter Field Name" ref="dddd" />
									</div>
								</div>
								<!-- Label -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[label]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Label: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<input type="text" class="form-control" :disabled="column.disabled" :value="toTitleCase(column.COLUMN_NAME)" :name="`${column.COLUMN_NAME}[label]`" :id="`${column.COLUMN_NAME}[label]`" placeholder="Enter Label Name" />
									</div>
								</div>
								<!-- Type -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[type]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Type: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<select class="form-select" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[type]`" :id="`${column.COLUMN_NAME}[type]`">
											<option disabled="" value="" selected>Select Type</option>
											<option value="Number">Number</option>
											<option value="String">String</option>
											<option value="Boolean">Boolean</option>
											<option value="Array">Array</option>
										</select>
									</div>
								</div>
								<!-- Table Component -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[tableComponent]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Table Component: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<select class="form-select" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[tableComponent]`" :id="`${column.COLUMN_NAME}[tableComponent]`">
											<option disabled="" value="" selected>Select Component</option>
											<option value="RegularText">RegularText</option>
											<option value="ThumbImage">ThumbImage</option>
											<option value="OptionBadge">OptionBadge</option>
											<option value="MultiBadge">MultiBadge</option>
											<option value="CheckboxGroup">CheckboxGroup</option>
										</select>
									</div>
								</div>
								<!-- Farm Component -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[formComponent]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Form Component: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<select class="form-select" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[formComponent]`" :id="`${column.COLUMN_NAME}[formComponent]`">
											<option disabled="" value="" selected>Select Component</option>
											<option value="InputText">InputText</option>
											<option value="RegularSelect">RegularSelect</option>
											<option value="Textarea">Textarea</option>
											<option value="File">File</option>
											<option value="Radio">Radio</option>
											<option value="Checkbox">Checkbox</option>
											<option value="CheckboxGroup">CheckboxGroup</option>
										</select>
									</div>
								</div>
								<!-- Searchable -->
								<div class="row mb-3 align-items-baseline">
									<label for="searchable" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label">Searchable: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<div class="d-flex flex-wrap align-items-center">
											<input type="text" class="form-control" :value="column.COLUMN_NAME" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[searchable]`" :id="`${column.COLUMN_NAME}[searchable]`" placeholder="Enter search Key" ref="ssss" />
										</div>
									</div>
								</div>
								<!-- Source -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[source]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Source: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<input type="text" class="form-control" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[source]`" :id="`${column.COLUMN_NAME}[source]`" placeholder="Enter Source" />
									</div>
								</div>
								<!-- Watching -->
								<div class="row mb-3 align-items-center">
									<label :for="`${column.COLUMN_NAME}[watching]`" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label"> Watching: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<input type="text" class="form-control" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[watching]`" :id="`${column.COLUMN_NAME}[watching]`" placeholder="Enter Watching Element" />
									</div>
								</div>
								<!-- Mount -->
								<div class="row mb-3 align-items-baseline">
									<label for="mount" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label">Mount: </label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<div class="d-flex flex-wrap align-items-center">
											<div class="form-check me-3">
												<input type="radio" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[mount]`" class="form-check-input" :id="`${column.COLUMN_NAME}[mount_yes]`" value="Yes" />
												<label class="form-check-label" :for="`${column.COLUMN_NAME}[mount_yes]`">Yes</label>
											</div>
											<div class="form-check me-3">
												<input type="radio" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[mount]`" class="form-check-input" :id="`${column.COLUMN_NAME}[mount_no]`" value="No" />
												<label class="form-check-label" :for="`${column.COLUMN_NAME}[mount_no]`">No</label>
											</div>
										</div>
									</div>
								</div>
								<!-- Validations -->
								<div class="row mb-3 align-items-baseline">
									<label for="options" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 col-xxl-3 col-form-label">Validations:</label>
									<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-xxl-9">
										<div class="input-group mb-2">
											<div class="form-check me-3">
												<input type="checkbox" :disabled="column.disabled" :id="`${column.COLUMN_NAME}[validations][required]`" :name="`${column.COLUMN_NAME}[validations][required]`" class="form-check-input" />
												<label :for="`${column.COLUMN_NAME}[validations][required]`" class="form-check-label">Required</label>
											</div>
											<div class="form-check me-3">
												<input type="checkbox" :disabled="column.disabled" :id="`${column.COLUMN_NAME}[validations][email]`" :name="`${column.COLUMN_NAME}[validations][email]`" class="form-check-input" />
												<label :for="`${column.COLUMN_NAME}[validations][email]`" class="form-check-label">Email</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End of First Column -->

							<!-- Divider -->
							<div class="col-1 text-center desktop">
								<div class="d-flex" style="height: 100%">
									<div class="vr mx-auto my-0 d-block"></div>
								</div>
							</div>
							<!-- End of Divider -->

							<!-- Right Column -->
							<div class="col-12 col-sm-12 col-md-12 col-lg">
								<div class="row mb-3 align-items-center">
									<label for="options" class="col-12 pt-0 col-form-label">Options:</label>
									<div class="col-12">
										<FieldOptions :column="column" :disabled="column.disabled" v-for="index in 12" :index="index" :key="index" />
									</div>
								</div>
							</div>
							<!-- End of Right Column -->

							<div class="col-12">
								<div class="fieldContainer">
									<h5 class="fieldContainerTitle">Extra fields</h5>
									<div class="row align-items-center">
										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4 mb-3">
											<label :for="`${column.COLUMN_NAME}[extraname]`" class="col-form-label"> Name: </label>
											<input type="text" class="form-control" :disabled="column.disabled" :value="column.COLUMN_NAME" :name="`${column.COLUMN_NAME}[extraname]`" :id="`${column.COLUMN_NAME}[extraname]`" placeholder="Enter Field Extra Name" />
										</div>

										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4 mb-3">
											<label :for="`${column.COLUMN_NAME}[extralabel]`" class="col-form-label"> Label: </label>
											<input type="text" class="form-control" :disabled="column.disabled" :value="toTitleCase(column.COLUMN_NAME)" :name="`${column.COLUMN_NAME}[extralabel]`" :id="`${column.COLUMN_NAME}[extralabel]`" placeholder="Enter Label Name" />
										</div>

										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4 mb-3">
											<label :for="`${column.COLUMN_NAME}[extraSearchable]`" class="col-form-label"> Searchable: </label>
											<input type="text" class="form-control" :value="column.COLUMN_NAME" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[extraSearchable]`" :id="`${column.COLUMN_NAME}[extraSearchable]`" placeholder="Enter search Key" />
										</div>

										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4 mb-3">
											<label :for="`${column.COLUMN_NAME}[extraType]`" class="col-form-label"> Type: </label>
											<select class="form-select" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[extraType]`" :id="`${column.COLUMN_NAME}[extraType]`">
												<option disabled="" value="" selected>Select Type</option>
												<option value="Number">Number</option>
												<option value="String">String</option>
												<option value="Boolean">Boolean</option>
												<option value="Array">Array</option>
											</select>
										</div>

										<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4 mb-3">
											<label :for="`${column.COLUMN_NAME}[extraTableComponent]`" class="col-form-label"> Table Component: </label>
											<select class="form-select" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[extraTableComponent]`" :id="`${column.COLUMN_NAME}[extraTableComponent]`">
												<option disabled="" value="" selected>Select Component</option>
												<option value="RegularText">RegularText</option>
												<option value="ThumbImage">ThumbImage</option>
												<option value="OptionBadge">OptionBadge</option>
												<option value="MultiBadge">MultiBadge</option>
												<option value="CheckboxGroup">CheckboxGroup</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="formFooterContainer d-flex justify-content-between align-items-center border-top">
				<button type="submit" class="btn btn-primary me-2">Submit</button>
			</div>
		</form>
		<pre>{{ value }}</pre>
	</div>
</template>

<script>
import axios from "axios";
import FieldOptions from "./FieldOptions";

export default {
	name: "TableField",
	components: {
		FieldOptions,
	},
	props: {
		columns: Array,
	},
	data() {
		return {
			value: String,
			cols: this.columns.filter(function (data) {
				data["disabled"] = true;
				return data.COLUMN_NAME != "ID";
			}),
		};
	},

	methods: {
		// incrementOptionsLenght(event) {
		// 	console.log(event);
		// 	this.optionslenght = this.optionslenght + 1;
		// },

		toggleDisabled(selectorId) {
			var filters = [{ COLUMN_NAME: selectorId }];
			var filteredData = this.cols.filter((CL) => {
				return filters.every(function (filter) {
					return Object.keys(filter).every(function (key) {
						return CL[key] === filter[key];
					});
				});
			});
			filteredData[0]["disabled"] = filteredData[0]["disabled"] == true ? false : true;
		},

		toTitleCase(text) {
			const result = text.replace(/([A-Z])/g, " $1");
			const finalResult = result.charAt(0).toUpperCase() + result.slice(1);
			return finalResult;
		},
		submit(event) {
			const formData = new FormData(event.target);
			axios
				.post("/test/generate-table-fields", formData)
				.then((response) => {
					this.value = response.data;
				})
				.catch((error) => console.log(error.message));
		},
	},

	computed: {
		gene() {
			for (let names of this.columns) {
				return names;
			}
		},
	},
};
</script>
