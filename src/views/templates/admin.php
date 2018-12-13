<div class="table_container">

	<div class="results_header">
		<h2 data-bind="text: modelTitle"></h2>
		<!-- ko if: subTitle -->
			<div class="alert alert-warning" data-bind="html: subTitle"></div>
		<!-- /ko -->


		<div class="actions">

			<!-- ko if: globalActions().length -->
				<!-- ko foreach: globalActions -->
					<!-- ko if: has_permission -->
						<input class="btn btn-w-m btn-warning" type="button" data-bind="click: function(){$root.customAction(false, action_name, messages, confirmation)}, value: title,
																		attr: {disabled: $root.freezeForm() || $root.freezeActions()}" />
					<!-- /ko -->
				<!-- /ko -->
			<!-- /ko -->
			<!-- ko if: actionPermissions.create -->
				<a class="btn btn-w-m btn-primary"
					data-bind="click: function() {$('.item_edit_container').fadeIn();$('#sidebar').fadeOut();$root.clickItem(0); return true},
								text: '<?php echo trans('administrator::administrator.new') ?> ' + modelSingle()"></a>
			<!-- /ko -->

			<input id="filter-btn-success" type="button" value="筛选" class="btn btn-w-m btn-success" />


		</div>

		<div class="action_message" data-bind="css: { error: globalStatusMessageType() == 'error', success: globalStatusMessageType() == 'success' },
										notification: globalStatusMessage "></div>
	</div>

	<div class="page_container">
		<div class="per_page">
			<button data-bind="click: function() {$root.updateRows()}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh inbox"><i class="fa fa-refresh"></i></button>

			<input type="hidden" data-bind="value: rowsPerPage, select2: {minimumResultsForSearch: -1, data: {results: rowsPerPageOptions},
											allowClear: false}" />
			<span> <?php echo trans('administrator::administrator.itemsperpage') ?></span>
		</div>
		<div class="paginator">

			<!-- ko if: $root.actionPermissions['delete'] !== false  -->
			<a type="button" id="delete-all" class="btn btn-danger btn-sm disabled" data-bind="click: deleteItems">
	            <i class="fa fa-trash" aria-hidden="true"></i> <?php echo trans('administrator::administrator.delete_all') ?>
	        </a>
	        <!-- /ko -->
	        
			Total: <span data-bind="text: pagination.total()"></span>&nbsp;&nbsp;
			<input type="button" class="btn btn-outline btn-primary btn-xs" value="<?php echo trans('administrator::administrator.previous') ?>"
					data-bind="attr: {disabled: pagination.isFirst() || !pagination.last() || !initialized() }, click: function() {page('prev')}" />
			<input type="button" class="btn btn-outline btn-primary btn-xs" value="<?php echo trans('administrator::administrator.next') ?>"
					data-bind="attr: {disabled: pagination.isLast() || !pagination.last() || !initialized() }, click: function() {page('next')}" />
			<input type="text" data-bind="attr: {disabled: pagination.last() === 0 || !initialized() }, value: pagination.page" />
			<span data-bind="text: ' / ' + pagination.last()"></span>
		</div>
	</div>

	<table class="results table table-hover" border="0" cellspacing="0" id="customers" cellpadding="0">
		<thead>
			<tr>
				<!-- ko if: $root.actionPermissions['delete'] !== false  -->
                <th><label for="select-all" style="white-space:nowrap;"><input id="select-all" type="checkbox" value=""> </label></th>
				<!-- /ko -->

				<!-- ko foreach: columns -->
					<th data-bind="visible: visible, css: {sortable: sortable,
	'sorted-asc': (column_name == $root.sortOptions.field() || sort_field == $root.sortOptions.field()) && $root.sortOptions.direction() === 'asc',
	'sorted-desc': (column_name == $root.sortOptions.field() || sort_field == $root.sortOptions.field()) && $root.sortOptions.direction() === 'desc'}">
						<!-- ko if: sortable -->
							<div data-bind="click: function() {$root.setSortOptions(sort_field ? sort_field : column_name)}, text: title"></div>
						<!-- /ko -->

						<!-- ko ifnot: sortable -->
							<div data-bind="text: title"></div>
						<!-- /ko -->
					</th>
				<!-- /ko -->
			</tr>
		</thead>
		<tbody>
			<!-- ko foreach: rows -->
				<tr data-bind="css: {result: true, even: $index() % 2 == 1, odd: $index() % 2 != 1,
									selected: $data[$root.primaryKey].raw == $root.itemLoadingId()}">
					
					<!-- ko if: $root.actionPermissions['delete'] !== false  -->
					<td><label for=""><input class="select-checkbox" data-bind="value:$data[$root.primaryKey].raw" type="checkbox"></td>
					<!-- /ko -->

					<!-- ko foreach: $root.columns -->

						<!-- ko ifnot: column_name === 'operation' -->
							<td data-bind="html: $parentContext.$data[column_name].rendered, visible: visible"></td>
						<!-- /ko -->

						<!-- ko if: column_name === 'operation' -->
							<td id="model_row_cell_operation">

								<div class="operation-row">
									<span data-bind="html: $parentContext.$data[column_name].rendered, visible: visible"></span>
									<a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bind="click: function() {$('.item_edit_container').fadeIn();$('#sidebar').fadeOut();$root.clickItem(0);$root.clickItem($parent[$root.primaryKey].raw); return true}">
										<!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
										<i class="fa fa-pencil-square" aria-hidden="true"></i>
										<i class="fa fa-pencil" aria-hidden="true"></i> -->
										<i class="fa fa-paint-brush" aria-hidden="true"></i>
									</a>


									<!-- ko if: $root.actionPermissions['delete'] !== false  -->
										<a type="button" class="btn btn-danger btn-sm" data-bind="click: function() {
											$root.deleteItem($root, event, $parent[$root.primaryKey].raw);
										}, attr: {disabled: $root.freezeForm() || $root.freezeActions()}">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</a>
									<!-- /ko -->
								</div>

							</td>
						<!-- /ko -->

					<!-- /ko -->
				</tr>
			<!-- /ko -->
		</tbody>
	</table>

	<div class="loading_rows" data-bind="visible: loadingRows">
		<div><?php echo trans('administrator::administrator.loading') ?></div>
	</div>

	<div class="no_results" data-bind="visible: pagination.last() === 0">
		<div><?php echo trans('administrator::administrator.noresults') ?></div>
	</div>
</div>

<div class="item_edit_container scrollable" data-bind="itemTransition: (activeItem() !== null || loadingItem()) && $('#sidebar').hide(), style: {width: expandWidth() + 'px'}">
	<div class="item_edit" data-bind="template: 'itemFormTemplate', style: {width: (expandWidth() - 10) + 'px'}"></div>
</div>
