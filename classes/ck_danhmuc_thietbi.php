<?php namespace PHPMaker2020\projectCoKhi; ?>
<?php

/**
 * Table class for ck_danhmuc_thietbi
 */
class ck_danhmuc_thietbi extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $thiet_bi_id;
	public $chung_loai_id;
	public $ky_ma_hieu;
	public $bo_phan;
	public $namsx;
	public $ghi_chu;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ck_danhmuc_thietbi';
		$this->TableName = 'ck_danhmuc_thietbi';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`ck_danhmuc_thietbi`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// thiet_bi_id
		$this->thiet_bi_id = new DbField('ck_danhmuc_thietbi', 'ck_danhmuc_thietbi', 'x_thiet_bi_id', 'thiet_bi_id', '`thiet_bi_id`', '`thiet_bi_id`', 3, 11, -1, FALSE, '`thiet_bi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->thiet_bi_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->thiet_bi_id->IsPrimaryKey = TRUE; // Primary key field
		$this->thiet_bi_id->IsForeignKey = TRUE; // Foreign key field
		$this->thiet_bi_id->Sortable = TRUE; // Allow sort
		$this->thiet_bi_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['thiet_bi_id'] = &$this->thiet_bi_id;

		// chung_loai_id
		$this->chung_loai_id = new DbField('ck_danhmuc_thietbi', 'ck_danhmuc_thietbi', 'x_chung_loai_id', 'chung_loai_id', '`chung_loai_id`', '`chung_loai_id`', 3, 11, -1, FALSE, '`EV__chung_loai_id`', TRUE, TRUE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->chung_loai_id->IsForeignKey = TRUE; // Foreign key field
		$this->chung_loai_id->Nullable = FALSE; // NOT NULL field
		$this->chung_loai_id->Required = TRUE; // Required field
		$this->chung_loai_id->Sortable = TRUE; // Allow sort
		$this->chung_loai_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->chung_loai_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->chung_loai_id->Lookup = new Lookup('chung_loai_id', 'ck_chungloai_thietbi', FALSE, 'chungloai_id', ["ten_chungloai","","",""], [], [], [], [], [], [], '', '');
		$this->chung_loai_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['chung_loai_id'] = &$this->chung_loai_id;

		// ky_ma_hieu
		$this->ky_ma_hieu = new DbField('ck_danhmuc_thietbi', 'ck_danhmuc_thietbi', 'x_ky_ma_hieu', 'ky_ma_hieu', '`ky_ma_hieu`', '`ky_ma_hieu`', 200, 100, -1, FALSE, '`ky_ma_hieu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ky_ma_hieu->Nullable = FALSE; // NOT NULL field
		$this->ky_ma_hieu->Required = TRUE; // Required field
		$this->ky_ma_hieu->Sortable = TRUE; // Allow sort
		$this->fields['ky_ma_hieu'] = &$this->ky_ma_hieu;

		// bo_phan
		$this->bo_phan = new DbField('ck_danhmuc_thietbi', 'ck_danhmuc_thietbi', 'x_bo_phan', 'bo_phan', '`bo_phan`', '`bo_phan`', 200, 50, -1, FALSE, '`bo_phan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bo_phan->Sortable = TRUE; // Allow sort
		$this->fields['bo_phan'] = &$this->bo_phan;

		// namsx
		$this->namsx = new DbField('ck_danhmuc_thietbi', 'ck_danhmuc_thietbi', 'x_namsx', 'namsx', '`namsx`', '`namsx`', 200, 50, -1, FALSE, '`namsx`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->namsx->Sortable = TRUE; // Allow sort
		$this->fields['namsx'] = &$this->namsx;

		// ghi_chu
		$this->ghi_chu = new DbField('ck_danhmuc_thietbi', 'ck_danhmuc_thietbi', 'x_ghi_chu', 'ghi_chu', '`ghi_chu`', '`ghi_chu`', 201, 500, -1, FALSE, '`ghi_chu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ghi_chu->Sortable = TRUE; // Allow sort
		$this->fields['ghi_chu'] = &$this->ghi_chu;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			$sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
			$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "ck_chungloai_thietbi") {
			if ($this->chung_loai_id->getSessionValue() != "")
				$masterFilter .= "`chungloai_id`=" . QuotedValue($this->chung_loai_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "ck_chungloai_thietbi") {
			if ($this->chung_loai_id->getSessionValue() != "")
				$detailFilter .= "`chung_loai_id`=" . QuotedValue($this->chung_loai_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_ck_chungloai_thietbi()
	{
		return "`chungloai_id`=@chungloai_id@";
	}

	// Detail filter
	public function sqlDetailFilter_ck_chungloai_thietbi()
	{
		return "`chung_loai_id`=@chung_loai_id@";
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "ck_view_nhatky_thietbi") {
			$detailUrl = $GLOBALS["ck_view_nhatky_thietbi"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_thiet_bi_id=" . urlencode($this->thiet_bi_id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "ck_danhmuc_thietbilist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ck_danhmuc_thietbi`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `ten_chungloai` FROM `ck_chungloai_thietbi` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`chungloai_id` = `ck_danhmuc_thietbi`.`chung_loai_id` LIMIT 1) AS `EV__chung_loai_id` FROM `ck_danhmuc_thietbi`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList != "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where != "")
			$where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
		if ($orderBy != "")
			$orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
		if (ContainsString($orderBy, " " . $this->chung_loai_id->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->thiet_bi_id->setDbValue($conn->insert_ID());
			$rs['thiet_bi_id'] = $this->thiet_bi_id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();

		// Cascade Update detail table 'ck_view_nhatky_thietbi'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['thiet_bi_id']) && $rsold['thiet_bi_id'] != $rs['thiet_bi_id'])) { // Update detail field 'thiet_bi_id'
			$cascadeUpdate = TRUE;
			$rscascade['thiet_bi_id'] = $rs['thiet_bi_id'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["ck_view_nhatky_thietbi"]))
				$GLOBALS["ck_view_nhatky_thietbi"] = new ck_view_nhatky_thietbi();
			$rswrk = $GLOBALS["ck_view_nhatky_thietbi"]->loadRs("`thiet_bi_id` = " . QuotedValue($rsold['thiet_bi_id'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'thiet_bi_id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["ck_view_nhatky_thietbi"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["ck_view_nhatky_thietbi"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["ck_view_nhatky_thietbi"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('thiet_bi_id', $rs))
				AddFilter($where, QuotedName('thiet_bi_id', $this->Dbid) . '=' . QuotedValue($rs['thiet_bi_id'], $this->thiet_bi_id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();

		// Cascade delete detail table 'ck_view_nhatky_thietbi'
		if (!isset($GLOBALS["ck_view_nhatky_thietbi"]))
			$GLOBALS["ck_view_nhatky_thietbi"] = new ck_view_nhatky_thietbi();
		$rscascade = $GLOBALS["ck_view_nhatky_thietbi"]->loadRs("`thiet_bi_id` = " . QuotedValue($rs['thiet_bi_id'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["ck_view_nhatky_thietbi"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["ck_view_nhatky_thietbi"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["ck_view_nhatky_thietbi"]->Row_Deleted($dtlrow);
		}
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->thiet_bi_id->DbValue = $row['thiet_bi_id'];
		$this->chung_loai_id->DbValue = $row['chung_loai_id'];
		$this->ky_ma_hieu->DbValue = $row['ky_ma_hieu'];
		$this->bo_phan->DbValue = $row['bo_phan'];
		$this->namsx->DbValue = $row['namsx'];
		$this->ghi_chu->DbValue = $row['ghi_chu'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`thiet_bi_id` = @thiet_bi_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('thiet_bi_id', $row) ? $row['thiet_bi_id'] : NULL;
		else
			$val = $this->thiet_bi_id->OldValue !== NULL ? $this->thiet_bi_id->OldValue : $this->thiet_bi_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@thiet_bi_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "ck_danhmuc_thietbilist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "ck_danhmuc_thietbiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ck_danhmuc_thietbiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ck_danhmuc_thietbiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ck_danhmuc_thietbilist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ck_danhmuc_thietbiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_danhmuc_thietbiview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ck_danhmuc_thietbiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ck_danhmuc_thietbiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ck_danhmuc_thietbiedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_danhmuc_thietbiedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ck_danhmuc_thietbiadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_danhmuc_thietbiadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("ck_danhmuc_thietbidelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "ck_chungloai_thietbi" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_chungloai_id=" . urlencode($this->chung_loai_id->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "thiet_bi_id:" . JsonEncode($this->thiet_bi_id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->thiet_bi_id->CurrentValue != NULL) {
			$url .= "thiet_bi_id=" . urlencode($this->thiet_bi_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("thiet_bi_id") !== NULL)
				$arKeys[] = Param("thiet_bi_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->thiet_bi_id->CurrentValue = $key;
			else
				$this->thiet_bi_id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->thiet_bi_id->setDbValue($rs->fields('thiet_bi_id'));
		$this->chung_loai_id->setDbValue($rs->fields('chung_loai_id'));
		$this->ky_ma_hieu->setDbValue($rs->fields('ky_ma_hieu'));
		$this->bo_phan->setDbValue($rs->fields('bo_phan'));
		$this->namsx->setDbValue($rs->fields('namsx'));
		$this->ghi_chu->setDbValue($rs->fields('ghi_chu'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// thiet_bi_id
		// chung_loai_id
		// ky_ma_hieu
		// bo_phan
		// namsx
		// ghi_chu
		// thiet_bi_id

		$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->CurrentValue;
		$this->thiet_bi_id->ViewValue = FormatNumber($this->thiet_bi_id->ViewValue, 0, -2, -2, -2);
		$this->thiet_bi_id->ViewCustomAttributes = "";

		// chung_loai_id
		if ($this->chung_loai_id->VirtualValue != "") {
			$this->chung_loai_id->ViewValue = $this->chung_loai_id->VirtualValue;
		} else {
			$curVal = strval($this->chung_loai_id->CurrentValue);
			if ($curVal != "") {
				$this->chung_loai_id->ViewValue = $this->chung_loai_id->lookupCacheOption($curVal);
				if ($this->chung_loai_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`chungloai_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->chung_loai_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->chung_loai_id->ViewValue = $this->chung_loai_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->chung_loai_id->ViewValue = $this->chung_loai_id->CurrentValue;
					}
				}
			} else {
				$this->chung_loai_id->ViewValue = NULL;
			}
		}
		$this->chung_loai_id->ViewCustomAttributes = "";

		// ky_ma_hieu
		$this->ky_ma_hieu->ViewValue = $this->ky_ma_hieu->CurrentValue;
		$this->ky_ma_hieu->ViewCustomAttributes = "";

		// bo_phan
		$this->bo_phan->ViewValue = $this->bo_phan->CurrentValue;
		$this->bo_phan->ViewCustomAttributes = "";

		// namsx
		$this->namsx->ViewValue = $this->namsx->CurrentValue;
		$this->namsx->ViewCustomAttributes = "";

		// ghi_chu
		$this->ghi_chu->ViewValue = $this->ghi_chu->CurrentValue;
		$this->ghi_chu->ViewCustomAttributes = "";

		// thiet_bi_id
		$this->thiet_bi_id->LinkCustomAttributes = "";
		$this->thiet_bi_id->HrefValue = "";
		$this->thiet_bi_id->TooltipValue = "";

		// chung_loai_id
		$this->chung_loai_id->LinkCustomAttributes = "";
		$this->chung_loai_id->HrefValue = "";
		$this->chung_loai_id->TooltipValue = "";

		// ky_ma_hieu
		$this->ky_ma_hieu->LinkCustomAttributes = "";
		$this->ky_ma_hieu->HrefValue = "";
		$this->ky_ma_hieu->TooltipValue = "";

		// bo_phan
		$this->bo_phan->LinkCustomAttributes = "";
		$this->bo_phan->HrefValue = "";
		$this->bo_phan->TooltipValue = "";

		// namsx
		$this->namsx->LinkCustomAttributes = "";
		$this->namsx->HrefValue = "";
		$this->namsx->TooltipValue = "";

		// ghi_chu
		$this->ghi_chu->LinkCustomAttributes = "";
		$this->ghi_chu->HrefValue = "";
		$this->ghi_chu->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// thiet_bi_id
		$this->thiet_bi_id->EditAttrs["class"] = "form-control";
		$this->thiet_bi_id->EditCustomAttributes = "";
		$this->thiet_bi_id->EditValue = $this->thiet_bi_id->CurrentValue;
		$this->thiet_bi_id->EditValue = FormatNumber($this->thiet_bi_id->EditValue, 0, -2, -2, -2);
		$this->thiet_bi_id->ViewCustomAttributes = "";

		// chung_loai_id
		$this->chung_loai_id->EditAttrs["class"] = "form-control";
		$this->chung_loai_id->EditCustomAttributes = "";
		if ($this->chung_loai_id->getSessionValue() != "") {
			$this->chung_loai_id->CurrentValue = $this->chung_loai_id->getSessionValue();
			if ($this->chung_loai_id->VirtualValue != "") {
				$this->chung_loai_id->ViewValue = $this->chung_loai_id->VirtualValue;
			} else {
				$curVal = strval($this->chung_loai_id->CurrentValue);
				if ($curVal != "") {
					$this->chung_loai_id->ViewValue = $this->chung_loai_id->lookupCacheOption($curVal);
					if ($this->chung_loai_id->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`chungloai_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->chung_loai_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->chung_loai_id->ViewValue = $this->chung_loai_id->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->chung_loai_id->ViewValue = $this->chung_loai_id->CurrentValue;
						}
					}
				} else {
					$this->chung_loai_id->ViewValue = NULL;
				}
			}
			$this->chung_loai_id->ViewCustomAttributes = "";
		} else {
		}

		// ky_ma_hieu
		$this->ky_ma_hieu->EditAttrs["class"] = "form-control";
		$this->ky_ma_hieu->EditCustomAttributes = "";
		if (!$this->ky_ma_hieu->Raw)
			$this->ky_ma_hieu->CurrentValue = HtmlDecode($this->ky_ma_hieu->CurrentValue);
		$this->ky_ma_hieu->EditValue = $this->ky_ma_hieu->CurrentValue;
		$this->ky_ma_hieu->PlaceHolder = RemoveHtml($this->ky_ma_hieu->caption());

		// bo_phan
		$this->bo_phan->EditAttrs["class"] = "form-control";
		$this->bo_phan->EditCustomAttributes = "";
		if (!$this->bo_phan->Raw)
			$this->bo_phan->CurrentValue = HtmlDecode($this->bo_phan->CurrentValue);
		$this->bo_phan->EditValue = $this->bo_phan->CurrentValue;
		$this->bo_phan->PlaceHolder = RemoveHtml($this->bo_phan->caption());

		// namsx
		$this->namsx->EditAttrs["class"] = "form-control";
		$this->namsx->EditCustomAttributes = "";
		if (!$this->namsx->Raw)
			$this->namsx->CurrentValue = HtmlDecode($this->namsx->CurrentValue);
		$this->namsx->EditValue = $this->namsx->CurrentValue;
		$this->namsx->PlaceHolder = RemoveHtml($this->namsx->caption());

		// ghi_chu
		$this->ghi_chu->EditAttrs["class"] = "form-control";
		$this->ghi_chu->EditCustomAttributes = "";
		$this->ghi_chu->EditValue = $this->ghi_chu->CurrentValue;
		$this->ghi_chu->PlaceHolder = RemoveHtml($this->ghi_chu->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->chung_loai_id);
					$doc->exportCaption($this->ky_ma_hieu);
					$doc->exportCaption($this->bo_phan);
					$doc->exportCaption($this->namsx);
					$doc->exportCaption($this->ghi_chu);
				} else {
					$doc->exportCaption($this->thiet_bi_id);
					$doc->exportCaption($this->chung_loai_id);
					$doc->exportCaption($this->ky_ma_hieu);
					$doc->exportCaption($this->bo_phan);
					$doc->exportCaption($this->namsx);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->chung_loai_id);
						$doc->exportField($this->ky_ma_hieu);
						$doc->exportField($this->bo_phan);
						$doc->exportField($this->namsx);
						$doc->exportField($this->ghi_chu);
					} else {
						$doc->exportField($this->thiet_bi_id);
						$doc->exportField($this->chung_loai_id);
						$doc->exportField($this->ky_ma_hieu);
						$doc->exportField($this->bo_phan);
						$doc->exportField($this->namsx);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>