<?php namespace PHPMaker2020\projectCoKhi; ?>
<?php

/**
 * Table class for ck_chitiet_suachua
 */
class ck_chitiet_suachua extends DbTable
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
	public $id;
	public $sua_chua_id;
	public $tennhanvien;
	public $nhan_vien_id;
	public $chuc_danh;
	public $ngay_sua_chua;
	public $thoi_gian;
	public $noi_dung;
	public $Picture;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ck_chitiet_suachua';
		$this->TableName = 'ck_chitiet_suachua';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`ck_chitiet_suachua`";
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
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = FALSE; // Allow sort
		$this->id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// sua_chua_id
		$this->sua_chua_id = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_sua_chua_id', 'sua_chua_id', '`sua_chua_id`', '`sua_chua_id`', 3, 11, -1, FALSE, '`sua_chua_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sua_chua_id->IsForeignKey = TRUE; // Foreign key field
		$this->sua_chua_id->Nullable = FALSE; // NOT NULL field
		$this->sua_chua_id->Required = TRUE; // Required field
		$this->sua_chua_id->Sortable = FALSE; // Allow sort
		$this->sua_chua_id->Lookup = new Lookup('sua_chua_id', 'ck_danhmuc_suachua', FALSE, 'sua_chua_id', ["noi_dung_sua_chua","","",""], [], [], [], [], [], [], '', '');
		$this->sua_chua_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sua_chua_id'] = &$this->sua_chua_id;

		// tennhanvien
		$this->tennhanvien = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_tennhanvien', 'tennhanvien', 'nhan_vien_id', 'nhan_vien_id', 3, 11, -1, FALSE, 'nhan_vien_id', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tennhanvien->IsCustom = TRUE; // Custom field
		$this->tennhanvien->Sortable = TRUE; // Allow sort
		$this->tennhanvien->Lookup = new Lookup('tennhanvien', 'nhan_vien', TRUE, 'nhan_vien_id', ["danh_so","","",""], [], [], [], [], [], [], '', '');
		$this->tennhanvien->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tennhanvien'] = &$this->tennhanvien;

		// nhan_vien_id
		$this->nhan_vien_id = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_nhan_vien_id', 'nhan_vien_id', '`nhan_vien_id`', '`nhan_vien_id`', 3, 11, -1, FALSE, '`nhan_vien_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nhan_vien_id->Nullable = FALSE; // NOT NULL field
		$this->nhan_vien_id->Required = TRUE; // Required field
		$this->nhan_vien_id->Sortable = FALSE; // Allow sort
		$this->nhan_vien_id->Lookup = new Lookup('nhan_vien_id', 'nhan_vien', FALSE, 'nhan_vien_id', ["ten_nhan_vien","","",""], [], [], [], [], [], [], '', '');
		$this->nhan_vien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nhan_vien_id'] = &$this->nhan_vien_id;

		// chuc_danh
		$this->chuc_danh = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_chuc_danh', 'chuc_danh', 'nhan_vien_id', 'nhan_vien_id', 3, 11, -1, FALSE, 'nhan_vien_id', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->chuc_danh->IsCustom = TRUE; // Custom field
		$this->chuc_danh->Sortable = FALSE; // Allow sort
		$this->chuc_danh->Lookup = new Lookup('chuc_danh', 'nhan_vien', FALSE, 'nhan_vien_id', ["chuc_danh","","",""], [], [], [], [], [], [], '', '');
		$this->chuc_danh->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['chuc_danh'] = &$this->chuc_danh;

		// ngay_sua_chua
		$this->ngay_sua_chua = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_ngay_sua_chua', 'ngay_sua_chua', '`ngay_sua_chua`', CastDateFieldForLike("`ngay_sua_chua`", 7, "DB"), 133, 10, 7, FALSE, '`ngay_sua_chua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_sua_chua->Sortable = FALSE; // Allow sort
		$this->ngay_sua_chua->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['ngay_sua_chua'] = &$this->ngay_sua_chua;

		// thoi_gian
		$this->thoi_gian = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_thoi_gian', 'thoi_gian', '`thoi_gian`', '`thoi_gian`', 4, 12, -1, FALSE, '`thoi_gian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->thoi_gian->Required = TRUE; // Required field
		$this->thoi_gian->Sortable = FALSE; // Allow sort
		$this->thoi_gian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['thoi_gian'] = &$this->thoi_gian;

		// noi_dung
		$this->noi_dung = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_noi_dung', 'noi_dung', '`noi_dung`', '`noi_dung`', 201, 1000, -1, FALSE, '`noi_dung`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->noi_dung->Sortable = FALSE; // Allow sort
		$this->fields['noi_dung'] = &$this->noi_dung;

		// Picture
		$this->Picture = new DbField('ck_chitiet_suachua', 'ck_chitiet_suachua', 'x_Picture', 'Picture', '`Picture`', '`Picture`', 205, 0, -1, TRUE, '`Picture`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->Picture->Sortable = TRUE; // Allow sort
		$this->Picture->ImageResize = TRUE;
		$this->fields['Picture'] = &$this->Picture;
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
		if ($this->getCurrentMasterTable() == "ck_danhmuc_suachua") {
			if ($this->sua_chua_id->getSessionValue() != "")
				$masterFilter .= "`sua_chua_id`=" . QuotedValue($this->sua_chua_id->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "ck_danhmuc_suachua") {
			if ($this->sua_chua_id->getSessionValue() != "")
				$detailFilter .= "`sua_chua_id`=" . QuotedValue($this->sua_chua_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_ck_danhmuc_suachua()
	{
		return "`sua_chua_id`=@sua_chua_id@";
	}

	// Detail filter
	public function sqlDetailFilter_ck_danhmuc_suachua()
	{
		return "`sua_chua_id`=@sua_chua_id@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ck_chitiet_suachua`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT *, nhan_vien_id AS `tennhanvien`, nhan_vien_id AS `chuc_danh` FROM " . $this->getSqlFrom();
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`ngay_sua_chua` DESC";
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

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
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
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
		$this->id->DbValue = $row['id'];
		$this->sua_chua_id->DbValue = $row['sua_chua_id'];
		$this->tennhanvien->DbValue = $row['tennhanvien'];
		$this->nhan_vien_id->DbValue = $row['nhan_vien_id'];
		$this->chuc_danh->DbValue = $row['chuc_danh'];
		$this->ngay_sua_chua->DbValue = $row['ngay_sua_chua'];
		$this->thoi_gian->DbValue = $row['thoi_gian'];
		$this->noi_dung->DbValue = $row['noi_dung'];
		$this->Picture->Upload->DbValue = $row['Picture'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "ck_chitiet_suachualist.php";
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
		if ($pageName == "ck_chitiet_suachuaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ck_chitiet_suachuaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ck_chitiet_suachuaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ck_chitiet_suachualist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ck_chitiet_suachuaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_chitiet_suachuaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ck_chitiet_suachuaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ck_chitiet_suachuaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("ck_chitiet_suachuaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("ck_chitiet_suachuaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("ck_chitiet_suachuadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "ck_danhmuc_suachua" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_sua_chua_id=" . urlencode($this->sua_chua_id->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
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
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
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
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
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
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
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
		$this->id->setDbValue($rs->fields('id'));
		$this->sua_chua_id->setDbValue($rs->fields('sua_chua_id'));
		$this->tennhanvien->setDbValue($rs->fields('tennhanvien'));
		$this->nhan_vien_id->setDbValue($rs->fields('nhan_vien_id'));
		$this->chuc_danh->setDbValue($rs->fields('chuc_danh'));
		$this->ngay_sua_chua->setDbValue($rs->fields('ngay_sua_chua'));
		$this->thoi_gian->setDbValue($rs->fields('thoi_gian'));
		$this->noi_dung->setDbValue($rs->fields('noi_dung'));
		$this->Picture->Upload->DbValue = $rs->fields('Picture');
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// sua_chua_id
		// tennhanvien
		// nhan_vien_id
		// chuc_danh
		// ngay_sua_chua
		// thoi_gian
		// noi_dung
		// Picture
		// id

		$this->id->ViewCustomAttributes = "";

		// sua_chua_id
		$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
		$curVal = strval($this->sua_chua_id->CurrentValue);
		if ($curVal != "") {
			$this->sua_chua_id->ViewValue = $this->sua_chua_id->lookupCacheOption($curVal);
			if ($this->sua_chua_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`sua_chua_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->sua_chua_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->sua_chua_id->ViewValue = $this->sua_chua_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
				}
			}
		} else {
			$this->sua_chua_id->ViewValue = NULL;
		}
		$this->sua_chua_id->ViewCustomAttributes = "";

		// tennhanvien
		$this->tennhanvien->ViewValue = $this->tennhanvien->CurrentValue;
		$curVal = strval($this->tennhanvien->CurrentValue);
		if ($curVal != "") {
			$this->tennhanvien->ViewValue = $this->tennhanvien->lookupCacheOption($curVal);
			if ($this->tennhanvien->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
				$sqlWrk = $this->tennhanvien->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn("diavatly")->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->tennhanvien->ViewValue = $this->tennhanvien->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tennhanvien->ViewValue = $this->tennhanvien->CurrentValue;
				}
			}
		} else {
			$this->tennhanvien->ViewValue = NULL;
		}
		$this->tennhanvien->ViewCustomAttributes = "";

		// nhan_vien_id
		$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->CurrentValue;
		$curVal = strval($this->nhan_vien_id->CurrentValue);
		if ($curVal != "") {
			$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->lookupCacheOption($curVal);
			if ($this->nhan_vien_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
				$sqlWrk = $this->nhan_vien_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn("diavatly")->execute($sqlWrk);
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

		// chuc_danh
		$this->chuc_danh->ViewValue = $this->chuc_danh->CurrentValue;
		$curVal = strval($this->chuc_danh->CurrentValue);
		if ($curVal != "") {
			$this->chuc_danh->ViewValue = $this->chuc_danh->lookupCacheOption($curVal);
			if ($this->chuc_danh->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
				$sqlWrk = $this->chuc_danh->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn("diavatly")->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->chuc_danh->ViewValue = $this->chuc_danh->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->chuc_danh->ViewValue = $this->chuc_danh->CurrentValue;
				}
			}
		} else {
			$this->chuc_danh->ViewValue = NULL;
		}
		$this->chuc_danh->ViewCustomAttributes = "";

		// ngay_sua_chua
		$this->ngay_sua_chua->ViewValue = $this->ngay_sua_chua->CurrentValue;
		$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->ViewValue, 7);
		$this->ngay_sua_chua->ViewCustomAttributes = "";

		// thoi_gian
		$this->thoi_gian->ViewValue = $this->thoi_gian->CurrentValue;
		$this->thoi_gian->ViewValue = FormatNumber($this->thoi_gian->ViewValue, 2, -2, -2, -2);
		$this->thoi_gian->ViewCustomAttributes = "";

		// noi_dung
		$this->noi_dung->ViewValue = $this->noi_dung->CurrentValue;
		$this->noi_dung->ViewCustomAttributes = "";

		// Picture
		if (!EmptyValue($this->Picture->Upload->DbValue)) {
			$this->Picture->ImageWidth = 0;
			$this->Picture->ImageHeight = 100;
			$this->Picture->ImageAlt = $this->Picture->alt();
			$this->Picture->ViewValue = $this->id->CurrentValue;
			$this->Picture->IsBlobImage = IsImageFile(ContentExtension($this->Picture->Upload->DbValue));
		} else {
			$this->Picture->ViewValue = "";
		}
		$this->Picture->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// sua_chua_id
		$this->sua_chua_id->LinkCustomAttributes = "";
		$this->sua_chua_id->HrefValue = "";
		$this->sua_chua_id->TooltipValue = "";

		// tennhanvien
		$this->tennhanvien->LinkCustomAttributes = "";
		$this->tennhanvien->HrefValue = "";
		$this->tennhanvien->TooltipValue = "";

		// nhan_vien_id
		$this->nhan_vien_id->LinkCustomAttributes = "";
		$this->nhan_vien_id->HrefValue = "";
		$this->nhan_vien_id->TooltipValue = "";

		// chuc_danh
		$this->chuc_danh->LinkCustomAttributes = "";
		$this->chuc_danh->HrefValue = "";
		$this->chuc_danh->TooltipValue = "";

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

		// Picture
		$this->Picture->LinkCustomAttributes = "";
		if (!empty($this->Picture->Upload->DbValue)) {
			$this->Picture->HrefValue = GetFileUploadUrl($this->Picture, $this->id->CurrentValue);
			$this->Picture->LinkAttrs["target"] = "";
			if ($this->Picture->IsBlobImage && empty($this->Picture->LinkAttrs["target"]))
				$this->Picture->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->Picture->HrefValue = FullUrl($this->Picture->HrefValue, "href");
		} else {
			$this->Picture->HrefValue = "";
		}
		$this->Picture->ExportHrefValue = GetFileUploadUrl($this->Picture, $this->id->CurrentValue);
		$this->Picture->TooltipValue = "";
		if ($this->Picture->UseColorbox) {
			if (EmptyValue($this->Picture->TooltipValue))
				$this->Picture->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->Picture->LinkAttrs["data-rel"] = "ck_chitiet_suachua_x_Picture";
			$this->Picture->LinkAttrs->appendClass("ew-lightbox");
		}

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

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->ViewCustomAttributes = "";

		// sua_chua_id
		$this->sua_chua_id->EditAttrs["class"] = "form-control";
		$this->sua_chua_id->EditCustomAttributes = "";
		if ($this->sua_chua_id->getSessionValue() != "") {
			$this->sua_chua_id->CurrentValue = $this->sua_chua_id->getSessionValue();
			$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
			$curVal = strval($this->sua_chua_id->CurrentValue);
			if ($curVal != "") {
				$this->sua_chua_id->ViewValue = $this->sua_chua_id->lookupCacheOption($curVal);
				if ($this->sua_chua_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`sua_chua_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sua_chua_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->sua_chua_id->ViewValue = $this->sua_chua_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
					}
				}
			} else {
				$this->sua_chua_id->ViewValue = NULL;
			}
			$this->sua_chua_id->ViewCustomAttributes = "";
		} else {
			$this->sua_chua_id->EditValue = $this->sua_chua_id->CurrentValue;
			$this->sua_chua_id->PlaceHolder = RemoveHtml($this->sua_chua_id->caption());
		}

		// tennhanvien
		$this->tennhanvien->EditAttrs["class"] = "form-control";
		$this->tennhanvien->EditCustomAttributes = "";
		$this->tennhanvien->EditValue = $this->tennhanvien->CurrentValue;
		$this->tennhanvien->PlaceHolder = RemoveHtml($this->tennhanvien->caption());

		// nhan_vien_id
		$this->nhan_vien_id->EditAttrs["class"] = "form-control";
		$this->nhan_vien_id->EditCustomAttributes = "";
		$this->nhan_vien_id->EditValue = $this->nhan_vien_id->CurrentValue;
		$this->nhan_vien_id->PlaceHolder = RemoveHtml($this->nhan_vien_id->caption());

		// chuc_danh
		$this->chuc_danh->EditAttrs["class"] = "form-control";
		$this->chuc_danh->EditCustomAttributes = "";
		$this->chuc_danh->EditValue = $this->chuc_danh->CurrentValue;
		$curVal = strval($this->chuc_danh->CurrentValue);
		if ($curVal != "") {
			$this->chuc_danh->EditValue = $this->chuc_danh->lookupCacheOption($curVal);
			if ($this->chuc_danh->EditValue === NULL) { // Lookup from database
				$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
				$sqlWrk = $this->chuc_danh->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn("diavatly")->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->chuc_danh->EditValue = $this->chuc_danh->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->chuc_danh->EditValue = $this->chuc_danh->CurrentValue;
				}
			}
		} else {
			$this->chuc_danh->EditValue = NULL;
		}
		$this->chuc_danh->ViewCustomAttributes = "";

		// ngay_sua_chua
		$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
		$this->ngay_sua_chua->EditCustomAttributes = "";
		$this->ngay_sua_chua->EditValue = FormatDateTime($this->ngay_sua_chua->CurrentValue, 7);
		$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());

		// thoi_gian
		$this->thoi_gian->EditAttrs["class"] = "form-control";
		$this->thoi_gian->EditCustomAttributes = "";
		$this->thoi_gian->EditValue = $this->thoi_gian->CurrentValue;
		$this->thoi_gian->PlaceHolder = RemoveHtml($this->thoi_gian->caption());
		if (strval($this->thoi_gian->EditValue) != "" && is_numeric($this->thoi_gian->EditValue))
			$this->thoi_gian->EditValue = FormatNumber($this->thoi_gian->EditValue, -2, -2, -2, -2);
		

		// noi_dung
		$this->noi_dung->EditAttrs["class"] = "form-control";
		$this->noi_dung->EditCustomAttributes = "";
		$this->noi_dung->EditValue = $this->noi_dung->CurrentValue;
		$this->noi_dung->PlaceHolder = RemoveHtml($this->noi_dung->caption());

		// Picture
		$this->Picture->EditAttrs["class"] = "form-control";
		$this->Picture->EditCustomAttributes = "";
		if (!EmptyValue($this->Picture->Upload->DbValue)) {
			$this->Picture->ImageWidth = 0;
			$this->Picture->ImageHeight = 100;
			$this->Picture->ImageAlt = $this->Picture->alt();
			$this->Picture->EditValue = $this->id->CurrentValue;
			$this->Picture->IsBlobImage = IsImageFile(ContentExtension($this->Picture->Upload->DbValue));
		} else {
			$this->Picture->EditValue = "";
		}

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
					$doc->exportCaption($this->chuc_danh);
					$doc->exportCaption($this->ngay_sua_chua);
					$doc->exportCaption($this->thoi_gian);
					$doc->exportCaption($this->noi_dung);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->sua_chua_id);
					$doc->exportCaption($this->tennhanvien);
					$doc->exportCaption($this->nhan_vien_id);
					$doc->exportCaption($this->chuc_danh);
					$doc->exportCaption($this->ngay_sua_chua);
					$doc->exportCaption($this->thoi_gian);
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
						$doc->exportField($this->chuc_danh);
						$doc->exportField($this->ngay_sua_chua);
						$doc->exportField($this->thoi_gian);
						$doc->exportField($this->noi_dung);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->sua_chua_id);
						$doc->exportField($this->tennhanvien);
						$doc->exportField($this->nhan_vien_id);
						$doc->exportField($this->chuc_danh);
						$doc->exportField($this->ngay_sua_chua);
						$doc->exportField($this->thoi_gian);
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
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'Picture') {
			$fldName = "Picture";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		//$sFilter = "bo_phan_id=18";
		//AddFilter($filter, $sFilter);

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

		if (CurrentUserLevel() == 0) { //the userlevel of the applicant
			$this->nhan_vien_id->ReadOnly = True;
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>