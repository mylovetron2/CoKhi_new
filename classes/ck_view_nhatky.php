<?php namespace PHPMaker2020\projectCoKhi; ?>
<?php

/**
 * Table class for ck_view_nhatky
 */
class ck_view_nhatky extends DbTable
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
	public $nhan_vien_id;
	public $ngay_sua_chua;
	public $thoi_gian;
	public $noi_dung;
	public $chuanloai_id;
	public $thiet_bi_id;
	public $so_don_hang_id;
	public $ngay_hoan_thanh;
	public $baoduong_dinhky;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ck_view_nhatky';
		$this->TableName = 'ck_view_nhatky';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`ck_view_nhatky`";
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

		// nhan_vien_id
		$this->nhan_vien_id = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_nhan_vien_id', 'nhan_vien_id', '`nhan_vien_id`', '`nhan_vien_id`', 3, 11, -1, FALSE, '`nhan_vien_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->nhan_vien_id->Nullable = FALSE; // NOT NULL field
		$this->nhan_vien_id->Required = TRUE; // Required field
		$this->nhan_vien_id->Sortable = TRUE; // Allow sort
		$this->nhan_vien_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nhan_vien_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->nhan_vien_id->Lookup = new Lookup('nhan_vien_id', 'ck_view_nhan_vien_ck', FALSE, 'nhan_vien_id', ["ten_nhan_vien","","",""], [], [], [], [], [], [], '', '');
		$this->nhan_vien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nhan_vien_id'] = &$this->nhan_vien_id;

		// ngay_sua_chua
		$this->ngay_sua_chua = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_ngay_sua_chua', 'ngay_sua_chua', '`ngay_sua_chua`', CastDateFieldForLike("`ngay_sua_chua`", 0, "DB"), 133, 10, 0, FALSE, '`ngay_sua_chua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_sua_chua->Sortable = TRUE; // Allow sort
		$this->ngay_sua_chua->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ngay_sua_chua'] = &$this->ngay_sua_chua;

		// thoi_gian
		$this->thoi_gian = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_thoi_gian', 'thoi_gian', '`thoi_gian`', '`thoi_gian`', 3, 11, -1, FALSE, '`thoi_gian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->thoi_gian->Sortable = TRUE; // Allow sort
		$this->thoi_gian->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['thoi_gian'] = &$this->thoi_gian;

		// noi_dung
		$this->noi_dung = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_noi_dung', 'noi_dung', '`noi_dung`', '`noi_dung`', 201, 1000, -1, FALSE, '`noi_dung`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->noi_dung->Sortable = TRUE; // Allow sort
		$this->fields['noi_dung'] = &$this->noi_dung;

		// chuanloai_id
		$this->chuanloai_id = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_chuanloai_id', 'chuanloai_id', '`chuanloai_id`', '`chuanloai_id`', 3, 11, -1, FALSE, '`chuanloai_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->chuanloai_id->Sortable = TRUE; // Allow sort
		$this->chuanloai_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->chuanloai_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->chuanloai_id->Lookup = new Lookup('chuanloai_id', 'ck_chungloai_thietbi', FALSE, 'chungloai_id', ["ten_chungloai","","",""], [], ["x_thiet_bi_id"], [], [], [], [], '', '');
		$this->chuanloai_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['chuanloai_id'] = &$this->chuanloai_id;

		// thiet_bi_id
		$this->thiet_bi_id = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_thiet_bi_id', 'thiet_bi_id', '`thiet_bi_id`', '`thiet_bi_id`', 3, 11, -1, FALSE, '`thiet_bi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->thiet_bi_id->Nullable = FALSE; // NOT NULL field
		$this->thiet_bi_id->Required = TRUE; // Required field
		$this->thiet_bi_id->Sortable = TRUE; // Allow sort
		$this->thiet_bi_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->thiet_bi_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->thiet_bi_id->Lookup = new Lookup('thiet_bi_id', 'ck_danhmuc_thietbi', FALSE, 'thiet_bi_id', ["ky_ma_hieu","","",""], ["x_chuanloai_id"], [], ["chung_loai_id"], ["x_chung_loai_id"], [], [], '', '');
		$this->thiet_bi_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['thiet_bi_id'] = &$this->thiet_bi_id;

		// so_don_hang_id
		$this->so_don_hang_id = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_so_don_hang_id', 'so_don_hang_id', '`so_don_hang_id`', '`so_don_hang_id`', 200, 110, -1, FALSE, '`so_don_hang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->so_don_hang_id->Nullable = FALSE; // NOT NULL field
		$this->so_don_hang_id->Required = TRUE; // Required field
		$this->so_don_hang_id->Sortable = TRUE; // Allow sort
		$this->fields['so_don_hang_id'] = &$this->so_don_hang_id;

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_ngay_hoan_thanh', 'ngay_hoan_thanh', '`ngay_hoan_thanh`', CastDateFieldForLike("`ngay_hoan_thanh`", 0, "DB"), 133, 10, 0, FALSE, '`ngay_hoan_thanh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_hoan_thanh->Sortable = TRUE; // Allow sort
		$this->ngay_hoan_thanh->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ngay_hoan_thanh'] = &$this->ngay_hoan_thanh;

		// baoduong_dinhky
		$this->baoduong_dinhky = new DbField('ck_view_nhatky', 'ck_view_nhatky', 'x_baoduong_dinhky', 'baoduong_dinhky', '`baoduong_dinhky`', '`baoduong_dinhky`', 16, 1, -1, FALSE, '`baoduong_dinhky`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->baoduong_dinhky->Sortable = TRUE; // Allow sort
		$this->baoduong_dinhky->DataType = DATATYPE_BOOLEAN;
		$this->baoduong_dinhky->Lookup = new Lookup('baoduong_dinhky', 'ck_view_nhatky', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->baoduong_dinhky->OptionCount = 2;
		$this->baoduong_dinhky->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['baoduong_dinhky'] = &$this->baoduong_dinhky;
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
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ck_view_nhatky`";
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
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
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
		$this->nhan_vien_id->DbValue = $row['nhan_vien_id'];
		$this->ngay_sua_chua->DbValue = $row['ngay_sua_chua'];
		$this->thoi_gian->DbValue = $row['thoi_gian'];
		$this->noi_dung->DbValue = $row['noi_dung'];
		$this->chuanloai_id->DbValue = $row['chuanloai_id'];
		$this->thiet_bi_id->DbValue = $row['thiet_bi_id'];
		$this->so_don_hang_id->DbValue = $row['so_don_hang_id'];
		$this->ngay_hoan_thanh->DbValue = $row['ngay_hoan_thanh'];
		$this->baoduong_dinhky->DbValue = $row['baoduong_dinhky'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
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
			return "ck_view_nhatkylist.php";
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
		if ($pageName == "ck_view_nhatkyview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ck_view_nhatkyedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ck_view_nhatkyadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ck_view_nhatkylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ck_view_nhatkyview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_view_nhatkyview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ck_view_nhatkyadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ck_view_nhatkyadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("ck_view_nhatkyedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("ck_view_nhatkyadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("ck_view_nhatkydelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
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

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
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
		$this->nhan_vien_id->setDbValue($rs->fields('nhan_vien_id'));
		$this->ngay_sua_chua->setDbValue($rs->fields('ngay_sua_chua'));
		$this->thoi_gian->setDbValue($rs->fields('thoi_gian'));
		$this->noi_dung->setDbValue($rs->fields('noi_dung'));
		$this->chuanloai_id->setDbValue($rs->fields('chuanloai_id'));
		$this->thiet_bi_id->setDbValue($rs->fields('thiet_bi_id'));
		$this->so_don_hang_id->setDbValue($rs->fields('so_don_hang_id'));
		$this->ngay_hoan_thanh->setDbValue($rs->fields('ngay_hoan_thanh'));
		$this->baoduong_dinhky->setDbValue($rs->fields('baoduong_dinhky'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// nhan_vien_id
		// ngay_sua_chua
		// thoi_gian
		// noi_dung
		// chuanloai_id
		// thiet_bi_id
		// so_don_hang_id
		// ngay_hoan_thanh
		// baoduong_dinhky
		// nhan_vien_id

		$curVal = strval($this->nhan_vien_id->CurrentValue);
		if ($curVal != "") {
			$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->lookupCacheOption($curVal);
			if ($this->nhan_vien_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->nhan_vien_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->CurrentValue;
				}
			}
		} else {
			$this->nhan_vien_id->ViewValue = NULL;
		}
		$this->nhan_vien_id->ViewCustomAttributes = "";

		// ngay_sua_chua
		$this->ngay_sua_chua->ViewValue = $this->ngay_sua_chua->CurrentValue;
		$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->ViewValue, 0);
		$this->ngay_sua_chua->ViewCustomAttributes = "";

		// thoi_gian
		$this->thoi_gian->ViewValue = $this->thoi_gian->CurrentValue;
		$this->thoi_gian->ViewValue = FormatNumber($this->thoi_gian->ViewValue, 0, -2, -2, -2);
		$this->thoi_gian->ViewCustomAttributes = "";

		// noi_dung
		$this->noi_dung->ViewValue = $this->noi_dung->CurrentValue;
		$this->noi_dung->ViewCustomAttributes = "";

		// chuanloai_id
		$curVal = strval($this->chuanloai_id->CurrentValue);
		if ($curVal != "") {
			$this->chuanloai_id->ViewValue = $this->chuanloai_id->lookupCacheOption($curVal);
			if ($this->chuanloai_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`chungloai_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->chuanloai_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->chuanloai_id->ViewValue = $this->chuanloai_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->chuanloai_id->ViewValue = $this->chuanloai_id->CurrentValue;
				}
			}
		} else {
			$this->chuanloai_id->ViewValue = NULL;
		}
		$this->chuanloai_id->ViewCustomAttributes = "";

		// thiet_bi_id
		$curVal = strval($this->thiet_bi_id->CurrentValue);
		if ($curVal != "") {
			$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->lookupCacheOption($curVal);
			if ($this->thiet_bi_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`thiet_bi_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->thiet_bi_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->CurrentValue;
				}
			}
		} else {
			$this->thiet_bi_id->ViewValue = NULL;
		}
		$this->thiet_bi_id->ViewCustomAttributes = "";

		// so_don_hang_id
		$this->so_don_hang_id->ViewValue = $this->so_don_hang_id->CurrentValue;
		$this->so_don_hang_id->ViewCustomAttributes = "";

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh->ViewValue = $this->ngay_hoan_thanh->CurrentValue;
		$this->ngay_hoan_thanh->ViewValue = FormatDateTime($this->ngay_hoan_thanh->ViewValue, 0);
		$this->ngay_hoan_thanh->ViewCustomAttributes = "";

		// baoduong_dinhky
		if (ConvertToBool($this->baoduong_dinhky->CurrentValue)) {
			$this->baoduong_dinhky->ViewValue = $this->baoduong_dinhky->tagCaption(1) != "" ? $this->baoduong_dinhky->tagCaption(1) : "Yes";
		} else {
			$this->baoduong_dinhky->ViewValue = $this->baoduong_dinhky->tagCaption(2) != "" ? $this->baoduong_dinhky->tagCaption(2) : "No";
		}
		$this->baoduong_dinhky->ViewCustomAttributes = "";

		// nhan_vien_id
		$this->nhan_vien_id->LinkCustomAttributes = "";
		$this->nhan_vien_id->HrefValue = "";
		$this->nhan_vien_id->TooltipValue = "";

		// ngay_sua_chua
		$this->ngay_sua_chua->LinkCustomAttributes = "";
		$this->ngay_sua_chua->HrefValue = "";
		$this->ngay_sua_chua->TooltipValue = "";

		// thoi_gian
		$this->thoi_gian->LinkCustomAttributes = "";
		$this->thoi_gian->HrefValue = "";
		$this->thoi_gian->TooltipValue = "";

		// noi_dung
		$this->noi_dung->LinkCustomAttributes = "";
		$this->noi_dung->HrefValue = "";
		$this->noi_dung->TooltipValue = "";

		// chuanloai_id
		$this->chuanloai_id->LinkCustomAttributes = "";
		$this->chuanloai_id->HrefValue = "";
		$this->chuanloai_id->TooltipValue = "";

		// thiet_bi_id
		$this->thiet_bi_id->LinkCustomAttributes = "";
		$this->thiet_bi_id->HrefValue = "";
		$this->thiet_bi_id->TooltipValue = "";

		// so_don_hang_id
		$this->so_don_hang_id->LinkCustomAttributes = "";
		$this->so_don_hang_id->HrefValue = "";
		$this->so_don_hang_id->TooltipValue = "";

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh->LinkCustomAttributes = "";
		$this->ngay_hoan_thanh->HrefValue = "";
		$this->ngay_hoan_thanh->TooltipValue = "";

		// baoduong_dinhky
		$this->baoduong_dinhky->LinkCustomAttributes = "";
		$this->baoduong_dinhky->HrefValue = "";
		$this->baoduong_dinhky->TooltipValue = "";

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

		// nhan_vien_id
		$this->nhan_vien_id->EditAttrs["class"] = "form-control";
		$this->nhan_vien_id->EditCustomAttributes = "";

		// ngay_sua_chua
		$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
		$this->ngay_sua_chua->EditCustomAttributes = "";
		$this->ngay_sua_chua->EditValue = FormatDateTime($this->ngay_sua_chua->CurrentValue, 8);
		$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());

		// thoi_gian
		$this->thoi_gian->EditAttrs["class"] = "form-control";
		$this->thoi_gian->EditCustomAttributes = "";
		$this->thoi_gian->EditValue = $this->thoi_gian->CurrentValue;
		$this->thoi_gian->PlaceHolder = RemoveHtml($this->thoi_gian->caption());

		// noi_dung
		$this->noi_dung->EditAttrs["class"] = "form-control";
		$this->noi_dung->EditCustomAttributes = "";
		$this->noi_dung->EditValue = $this->noi_dung->CurrentValue;
		$this->noi_dung->PlaceHolder = RemoveHtml($this->noi_dung->caption());

		// chuanloai_id
		$this->chuanloai_id->EditAttrs["class"] = "form-control";
		$this->chuanloai_id->EditCustomAttributes = "";

		// thiet_bi_id
		$this->thiet_bi_id->EditAttrs["class"] = "form-control";
		$this->thiet_bi_id->EditCustomAttributes = "";

		// so_don_hang_id
		$this->so_don_hang_id->EditAttrs["class"] = "form-control";
		$this->so_don_hang_id->EditCustomAttributes = "";
		if (!$this->so_don_hang_id->Raw)
			$this->so_don_hang_id->CurrentValue = HtmlDecode($this->so_don_hang_id->CurrentValue);
		$this->so_don_hang_id->EditValue = $this->so_don_hang_id->CurrentValue;
		$this->so_don_hang_id->PlaceHolder = RemoveHtml($this->so_don_hang_id->caption());

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh->EditAttrs["class"] = "form-control";
		$this->ngay_hoan_thanh->EditCustomAttributes = "";
		$this->ngay_hoan_thanh->EditValue = FormatDateTime($this->ngay_hoan_thanh->CurrentValue, 8);
		$this->ngay_hoan_thanh->PlaceHolder = RemoveHtml($this->ngay_hoan_thanh->caption());

		// baoduong_dinhky
		$this->baoduong_dinhky->EditCustomAttributes = "";
		$this->baoduong_dinhky->EditValue = $this->baoduong_dinhky->options(FALSE);

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
					$doc->exportCaption($this->nhan_vien_id);
					$doc->exportCaption($this->ngay_sua_chua);
					$doc->exportCaption($this->thoi_gian);
					$doc->exportCaption($this->noi_dung);
					$doc->exportCaption($this->chuanloai_id);
					$doc->exportCaption($this->thiet_bi_id);
					$doc->exportCaption($this->so_don_hang_id);
					$doc->exportCaption($this->ngay_hoan_thanh);
					$doc->exportCaption($this->baoduong_dinhky);
				} else {
					$doc->exportCaption($this->nhan_vien_id);
					$doc->exportCaption($this->ngay_sua_chua);
					$doc->exportCaption($this->thoi_gian);
					$doc->exportCaption($this->chuanloai_id);
					$doc->exportCaption($this->thiet_bi_id);
					$doc->exportCaption($this->so_don_hang_id);
					$doc->exportCaption($this->ngay_hoan_thanh);
					$doc->exportCaption($this->baoduong_dinhky);
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
						$doc->exportField($this->nhan_vien_id);
						$doc->exportField($this->ngay_sua_chua);
						$doc->exportField($this->thoi_gian);
						$doc->exportField($this->noi_dung);
						$doc->exportField($this->chuanloai_id);
						$doc->exportField($this->thiet_bi_id);
						$doc->exportField($this->so_don_hang_id);
						$doc->exportField($this->ngay_hoan_thanh);
						$doc->exportField($this->baoduong_dinhky);
					} else {
						$doc->exportField($this->nhan_vien_id);
						$doc->exportField($this->ngay_sua_chua);
						$doc->exportField($this->thoi_gian);
						$doc->exportField($this->chuanloai_id);
						$doc->exportField($this->thiet_bi_id);
						$doc->exportField($this->so_don_hang_id);
						$doc->exportField($this->ngay_hoan_thanh);
						$doc->exportField($this->baoduong_dinhky);
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