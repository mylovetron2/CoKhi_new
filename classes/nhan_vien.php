<?php namespace PHPMaker2020\projectCoKhi; ?>
<?php

/**
 * Table class for nhan_vien
 */
class nhan_vien extends DbTable
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
	public $danh_so;
	public $ten_nhan_vien;
	public $chuc_danh;
	public $luong;
	public $ngay_vao_dk;
	public $ngay_vao_ld;
	public $ngayll;
	public $ngay_sinh;
	public $ncl1;
	public $ncl2;
	public $ncl3;
	public $DTCQ;
	public $DTNR;
	public $DTDD;
	public $que_quan;
	public $dia_chi_noi_o;
	public $cmnd;
	public $noi_cap;
	public $ngay_cap;
	public $bo_phan_id;
	public $username;
	public $password;
	public $_userlevel;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'nhan_vien';
		$this->TableName = 'nhan_vien';
		$this->TableType = 'LINKTABLE';

		// Update Table
		$this->UpdateTable = "`nhan_vien`";
		$this->Dbid = 'diavatly';
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
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// nhan_vien_id
		$this->nhan_vien_id = new DbField('nhan_vien', 'nhan_vien', 'x_nhan_vien_id', 'nhan_vien_id', '`nhan_vien_id`', '`nhan_vien_id`', 3, 11, -1, FALSE, '`nhan_vien_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->nhan_vien_id->IsPrimaryKey = TRUE; // Primary key field
		$this->nhan_vien_id->Nullable = FALSE; // NOT NULL field
		$this->nhan_vien_id->Required = TRUE; // Required field
		$this->nhan_vien_id->Sortable = TRUE; // Allow sort
		$this->nhan_vien_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nhan_vien_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->nhan_vien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nhan_vien_id'] = &$this->nhan_vien_id;

		// danh_so
		$this->danh_so = new DbField('nhan_vien', 'nhan_vien', 'x_danh_so', 'danh_so', '`danh_so`', '`danh_so`', 3, 11, -1, FALSE, '`danh_so`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->danh_so->Nullable = FALSE; // NOT NULL field
		$this->danh_so->Required = TRUE; // Required field
		$this->danh_so->Sortable = TRUE; // Allow sort
		$this->danh_so->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['danh_so'] = &$this->danh_so;

		// ten_nhan_vien
		$this->ten_nhan_vien = new DbField('nhan_vien', 'nhan_vien', 'x_ten_nhan_vien', 'ten_nhan_vien', '`ten_nhan_vien`', '`ten_nhan_vien`', 200, 50, -1, FALSE, '`ten_nhan_vien`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ten_nhan_vien->Nullable = FALSE; // NOT NULL field
		$this->ten_nhan_vien->Required = TRUE; // Required field
		$this->ten_nhan_vien->Sortable = TRUE; // Allow sort
		$this->fields['ten_nhan_vien'] = &$this->ten_nhan_vien;

		// chuc_danh
		$this->chuc_danh = new DbField('nhan_vien', 'nhan_vien', 'x_chuc_danh', 'chuc_danh', '`chuc_danh`', '`chuc_danh`', 200, 50, -1, FALSE, '`chuc_danh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->chuc_danh->Sortable = TRUE; // Allow sort
		$this->fields['chuc_danh'] = &$this->chuc_danh;

		// luong
		$this->luong = new DbField('nhan_vien', 'nhan_vien', 'x_luong', 'luong', '`luong`', '`luong`', 3, 11, -1, FALSE, '`luong`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->luong->Sortable = TRUE; // Allow sort
		$this->luong->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['luong'] = &$this->luong;

		// ngay_vao_dk
		$this->ngay_vao_dk = new DbField('nhan_vien', 'nhan_vien', 'x_ngay_vao_dk', 'ngay_vao_dk', '`ngay_vao_dk`', CastDateFieldForLike("`ngay_vao_dk`", 0, "diavatly"), 133, 10, 0, FALSE, '`ngay_vao_dk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_vao_dk->Sortable = TRUE; // Allow sort
		$this->ngay_vao_dk->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ngay_vao_dk'] = &$this->ngay_vao_dk;

		// ngay_vao_ld
		$this->ngay_vao_ld = new DbField('nhan_vien', 'nhan_vien', 'x_ngay_vao_ld', 'ngay_vao_ld', '`ngay_vao_ld`', CastDateFieldForLike("`ngay_vao_ld`", 0, "diavatly"), 133, 10, 0, FALSE, '`ngay_vao_ld`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_vao_ld->Sortable = TRUE; // Allow sort
		$this->ngay_vao_ld->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ngay_vao_ld'] = &$this->ngay_vao_ld;

		// ngayll
		$this->ngayll = new DbField('nhan_vien', 'nhan_vien', 'x_ngayll', 'ngayll', '`ngayll`', CastDateFieldForLike("`ngayll`", 0, "diavatly"), 133, 10, 0, FALSE, '`ngayll`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngayll->Sortable = TRUE; // Allow sort
		$this->ngayll->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ngayll'] = &$this->ngayll;

		// ngay_sinh
		$this->ngay_sinh = new DbField('nhan_vien', 'nhan_vien', 'x_ngay_sinh', 'ngay_sinh', '`ngay_sinh`', CastDateFieldForLike("`ngay_sinh`", 0, "diavatly"), 133, 10, 0, FALSE, '`ngay_sinh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_sinh->Sortable = TRUE; // Allow sort
		$this->ngay_sinh->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ngay_sinh'] = &$this->ngay_sinh;

		// ncl1
		$this->ncl1 = new DbField('nhan_vien', 'nhan_vien', 'x_ncl1', 'ncl1', '`ncl1`', CastDateFieldForLike("`ncl1`", 0, "diavatly"), 133, 10, 0, FALSE, '`ncl1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ncl1->Sortable = TRUE; // Allow sort
		$this->ncl1->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ncl1'] = &$this->ncl1;

		// ncl2
		$this->ncl2 = new DbField('nhan_vien', 'nhan_vien', 'x_ncl2', 'ncl2', '`ncl2`', CastDateFieldForLike("`ncl2`", 0, "diavatly"), 133, 10, 0, FALSE, '`ncl2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ncl2->Sortable = TRUE; // Allow sort
		$this->ncl2->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ncl2'] = &$this->ncl2;

		// ncl3
		$this->ncl3 = new DbField('nhan_vien', 'nhan_vien', 'x_ncl3', 'ncl3', '`ncl3`', CastDateFieldForLike("`ncl3`", 0, "diavatly"), 133, 10, 0, FALSE, '`ncl3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ncl3->Sortable = TRUE; // Allow sort
		$this->ncl3->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ncl3'] = &$this->ncl3;

		// DTCQ
		$this->DTCQ = new DbField('nhan_vien', 'nhan_vien', 'x_DTCQ', 'DTCQ', '`DTCQ`', '`DTCQ`', 200, 20, -1, FALSE, '`DTCQ`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DTCQ->Sortable = TRUE; // Allow sort
		$this->fields['DTCQ'] = &$this->DTCQ;

		// DTNR
		$this->DTNR = new DbField('nhan_vien', 'nhan_vien', 'x_DTNR', 'DTNR', '`DTNR`', '`DTNR`', 200, 20, -1, FALSE, '`DTNR`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DTNR->Sortable = TRUE; // Allow sort
		$this->fields['DTNR'] = &$this->DTNR;

		// DTDD
		$this->DTDD = new DbField('nhan_vien', 'nhan_vien', 'x_DTDD', 'DTDD', '`DTDD`', '`DTDD`', 200, 20, -1, FALSE, '`DTDD`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DTDD->Sortable = TRUE; // Allow sort
		$this->fields['DTDD'] = &$this->DTDD;

		// que_quan
		$this->que_quan = new DbField('nhan_vien', 'nhan_vien', 'x_que_quan', 'que_quan', '`que_quan`', '`que_quan`', 200, 50, -1, FALSE, '`que_quan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->que_quan->Sortable = TRUE; // Allow sort
		$this->fields['que_quan'] = &$this->que_quan;

		// dia_chi_noi_o
		$this->dia_chi_noi_o = new DbField('nhan_vien', 'nhan_vien', 'x_dia_chi_noi_o', 'dia_chi_noi_o', '`dia_chi_noi_o`', '`dia_chi_noi_o`', 200, 100, -1, FALSE, '`dia_chi_noi_o`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dia_chi_noi_o->Sortable = TRUE; // Allow sort
		$this->fields['dia_chi_noi_o'] = &$this->dia_chi_noi_o;

		// cmnd
		$this->cmnd = new DbField('nhan_vien', 'nhan_vien', 'x_cmnd', 'cmnd', '`cmnd`', '`cmnd`', 200, 15, -1, FALSE, '`cmnd`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cmnd->Sortable = TRUE; // Allow sort
		$this->fields['cmnd'] = &$this->cmnd;

		// noi_cap
		$this->noi_cap = new DbField('nhan_vien', 'nhan_vien', 'x_noi_cap', 'noi_cap', '`noi_cap`', '`noi_cap`', 200, 50, -1, FALSE, '`noi_cap`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noi_cap->Sortable = TRUE; // Allow sort
		$this->fields['noi_cap'] = &$this->noi_cap;

		// ngay_cap
		$this->ngay_cap = new DbField('nhan_vien', 'nhan_vien', 'x_ngay_cap', 'ngay_cap', '`ngay_cap`', CastDateFieldForLike("`ngay_cap`", 0, "diavatly"), 133, 10, 0, FALSE, '`ngay_cap`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_cap->Sortable = TRUE; // Allow sort
		$this->ngay_cap->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ngay_cap'] = &$this->ngay_cap;

		// bo_phan_id
		$this->bo_phan_id = new DbField('nhan_vien', 'nhan_vien', 'x_bo_phan_id', 'bo_phan_id', '`bo_phan_id`', '`bo_phan_id`', 3, 11, -1, FALSE, '`bo_phan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bo_phan_id->Sortable = TRUE; // Allow sort
		$this->bo_phan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['bo_phan_id'] = &$this->bo_phan_id;

		// username
		$this->username = new DbField('nhan_vien', 'nhan_vien', 'x_username', 'username', '`username`', '`username`', 200, 50, -1, FALSE, '`username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->username->Nullable = FALSE; // NOT NULL field
		$this->username->Required = TRUE; // Required field
		$this->username->Sortable = TRUE; // Allow sort
		$this->fields['username'] = &$this->username;

		// password
		$this->password = new DbField('nhan_vien', 'nhan_vien', 'x_password', 'password', '`password`', '`password`', 200, 50, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->password->Nullable = FALSE; // NOT NULL field
		$this->password->Required = TRUE; // Required field
		$this->password->Sortable = TRUE; // Allow sort
		$this->fields['password'] = &$this->password;

		// userlevel
		$this->_userlevel = new DbField('nhan_vien', 'nhan_vien', 'x__userlevel', 'userlevel', '`userlevel`', '`userlevel`', 3, 11, -1, FALSE, '`userlevel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->_userlevel->Nullable = FALSE; // NOT NULL field
		$this->_userlevel->Required = TRUE; // Required field
		$this->_userlevel->Sortable = TRUE; // Allow sort
		$this->_userlevel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->_userlevel->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->_userlevel->Lookup = new Lookup('userlevel', 'userlevels', FALSE, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '');
		$this->_userlevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['userlevel'] = &$this->_userlevel;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`nhan_vien`";
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
		global $Security;

		// Add User ID filter
		if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
			$filter = $this->addUserIDFilter($filter, $id);
		}
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
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME"))
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
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
			if (array_key_exists('nhan_vien_id', $rs))
				AddFilter($where, QuotedName('nhan_vien_id', $this->Dbid) . '=' . QuotedValue($rs['nhan_vien_id'], $this->nhan_vien_id->DataType, $this->Dbid));
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
		$this->danh_so->DbValue = $row['danh_so'];
		$this->ten_nhan_vien->DbValue = $row['ten_nhan_vien'];
		$this->chuc_danh->DbValue = $row['chuc_danh'];
		$this->luong->DbValue = $row['luong'];
		$this->ngay_vao_dk->DbValue = $row['ngay_vao_dk'];
		$this->ngay_vao_ld->DbValue = $row['ngay_vao_ld'];
		$this->ngayll->DbValue = $row['ngayll'];
		$this->ngay_sinh->DbValue = $row['ngay_sinh'];
		$this->ncl1->DbValue = $row['ncl1'];
		$this->ncl2->DbValue = $row['ncl2'];
		$this->ncl3->DbValue = $row['ncl3'];
		$this->DTCQ->DbValue = $row['DTCQ'];
		$this->DTNR->DbValue = $row['DTNR'];
		$this->DTDD->DbValue = $row['DTDD'];
		$this->que_quan->DbValue = $row['que_quan'];
		$this->dia_chi_noi_o->DbValue = $row['dia_chi_noi_o'];
		$this->cmnd->DbValue = $row['cmnd'];
		$this->noi_cap->DbValue = $row['noi_cap'];
		$this->ngay_cap->DbValue = $row['ngay_cap'];
		$this->bo_phan_id->DbValue = $row['bo_phan_id'];
		$this->username->DbValue = $row['username'];
		$this->password->DbValue = $row['password'];
		$this->_userlevel->DbValue = $row['userlevel'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`nhan_vien_id` = @nhan_vien_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('nhan_vien_id', $row) ? $row['nhan_vien_id'] : NULL;
		else
			$val = $this->nhan_vien_id->OldValue !== NULL ? $this->nhan_vien_id->OldValue : $this->nhan_vien_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@nhan_vien_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "nhan_vienlist.php";
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
		if ($pageName == "nhan_vienview.php")
			return $Language->phrase("View");
		elseif ($pageName == "nhan_vienedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "nhan_vienadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "nhan_vienlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("nhan_vienview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("nhan_vienview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "nhan_vienadd.php?" . $this->getUrlParm($parm);
		else
			$url = "nhan_vienadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("nhan_vienedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("nhan_vienadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("nhan_viendelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "nhan_vien_id:" . JsonEncode($this->nhan_vien_id->CurrentValue, "number");
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
		if ($this->nhan_vien_id->CurrentValue != NULL) {
			$url .= "nhan_vien_id=" . urlencode($this->nhan_vien_id->CurrentValue);
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
			if (Param("nhan_vien_id") !== NULL)
				$arKeys[] = Param("nhan_vien_id");
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
				$this->nhan_vien_id->CurrentValue = $key;
			else
				$this->nhan_vien_id->OldValue = $key;
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
		$this->danh_so->setDbValue($rs->fields('danh_so'));
		$this->ten_nhan_vien->setDbValue($rs->fields('ten_nhan_vien'));
		$this->chuc_danh->setDbValue($rs->fields('chuc_danh'));
		$this->luong->setDbValue($rs->fields('luong'));
		$this->ngay_vao_dk->setDbValue($rs->fields('ngay_vao_dk'));
		$this->ngay_vao_ld->setDbValue($rs->fields('ngay_vao_ld'));
		$this->ngayll->setDbValue($rs->fields('ngayll'));
		$this->ngay_sinh->setDbValue($rs->fields('ngay_sinh'));
		$this->ncl1->setDbValue($rs->fields('ncl1'));
		$this->ncl2->setDbValue($rs->fields('ncl2'));
		$this->ncl3->setDbValue($rs->fields('ncl3'));
		$this->DTCQ->setDbValue($rs->fields('DTCQ'));
		$this->DTNR->setDbValue($rs->fields('DTNR'));
		$this->DTDD->setDbValue($rs->fields('DTDD'));
		$this->que_quan->setDbValue($rs->fields('que_quan'));
		$this->dia_chi_noi_o->setDbValue($rs->fields('dia_chi_noi_o'));
		$this->cmnd->setDbValue($rs->fields('cmnd'));
		$this->noi_cap->setDbValue($rs->fields('noi_cap'));
		$this->ngay_cap->setDbValue($rs->fields('ngay_cap'));
		$this->bo_phan_id->setDbValue($rs->fields('bo_phan_id'));
		$this->username->setDbValue($rs->fields('username'));
		$this->password->setDbValue($rs->fields('password'));
		$this->_userlevel->setDbValue($rs->fields('userlevel'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// nhan_vien_id
		// danh_so
		// ten_nhan_vien
		// chuc_danh
		// luong
		// ngay_vao_dk
		// ngay_vao_ld
		// ngayll
		// ngay_sinh
		// ncl1
		// ncl2
		// ncl3
		// DTCQ
		// DTNR
		// DTDD
		// que_quan
		// dia_chi_noi_o
		// cmnd
		// noi_cap
		// ngay_cap
		// bo_phan_id
		// username
		// password
		// userlevel
		// nhan_vien_id

		$this->nhan_vien_id->ViewValue = FormatNumber($this->nhan_vien_id->ViewValue, 0, -2, -2, -2);
		$this->nhan_vien_id->ViewCustomAttributes = "";

		// danh_so
		$this->danh_so->ViewValue = $this->danh_so->CurrentValue;
		$this->danh_so->ViewCustomAttributes = "";

		// ten_nhan_vien
		$this->ten_nhan_vien->ViewValue = $this->ten_nhan_vien->CurrentValue;
		$this->ten_nhan_vien->ViewCustomAttributes = "";

		// chuc_danh
		$this->chuc_danh->ViewValue = $this->chuc_danh->CurrentValue;
		$this->chuc_danh->ViewCustomAttributes = "";

		// luong
		$this->luong->ViewValue = $this->luong->CurrentValue;
		$this->luong->ViewValue = FormatNumber($this->luong->ViewValue, 0, -2, -2, -2);
		$this->luong->ViewCustomAttributes = "";

		// ngay_vao_dk
		$this->ngay_vao_dk->ViewValue = $this->ngay_vao_dk->CurrentValue;
		$this->ngay_vao_dk->ViewValue = FormatDateTime($this->ngay_vao_dk->ViewValue, 0);
		$this->ngay_vao_dk->ViewCustomAttributes = "";

		// ngay_vao_ld
		$this->ngay_vao_ld->ViewValue = $this->ngay_vao_ld->CurrentValue;
		$this->ngay_vao_ld->ViewValue = FormatDateTime($this->ngay_vao_ld->ViewValue, 0);
		$this->ngay_vao_ld->ViewCustomAttributes = "";

		// ngayll
		$this->ngayll->ViewValue = $this->ngayll->CurrentValue;
		$this->ngayll->ViewValue = FormatDateTime($this->ngayll->ViewValue, 0);
		$this->ngayll->ViewCustomAttributes = "";

		// ngay_sinh
		$this->ngay_sinh->ViewValue = $this->ngay_sinh->CurrentValue;
		$this->ngay_sinh->ViewValue = FormatDateTime($this->ngay_sinh->ViewValue, 0);
		$this->ngay_sinh->ViewCustomAttributes = "";

		// ncl1
		$this->ncl1->ViewValue = $this->ncl1->CurrentValue;
		$this->ncl1->ViewValue = FormatDateTime($this->ncl1->ViewValue, 0);
		$this->ncl1->ViewCustomAttributes = "";

		// ncl2
		$this->ncl2->ViewValue = $this->ncl2->CurrentValue;
		$this->ncl2->ViewValue = FormatDateTime($this->ncl2->ViewValue, 0);
		$this->ncl2->ViewCustomAttributes = "";

		// ncl3
		$this->ncl3->ViewValue = $this->ncl3->CurrentValue;
		$this->ncl3->ViewValue = FormatDateTime($this->ncl3->ViewValue, 0);
		$this->ncl3->ViewCustomAttributes = "";

		// DTCQ
		$this->DTCQ->ViewValue = $this->DTCQ->CurrentValue;
		$this->DTCQ->ViewCustomAttributes = "";

		// DTNR
		$this->DTNR->ViewValue = $this->DTNR->CurrentValue;
		$this->DTNR->ViewCustomAttributes = "";

		// DTDD
		$this->DTDD->ViewValue = $this->DTDD->CurrentValue;
		$this->DTDD->ViewCustomAttributes = "";

		// que_quan
		$this->que_quan->ViewValue = $this->que_quan->CurrentValue;
		$this->que_quan->ViewCustomAttributes = "";

		// dia_chi_noi_o
		$this->dia_chi_noi_o->ViewValue = $this->dia_chi_noi_o->CurrentValue;
		$this->dia_chi_noi_o->ViewCustomAttributes = "";

		// cmnd
		$this->cmnd->ViewValue = $this->cmnd->CurrentValue;
		$this->cmnd->ViewCustomAttributes = "";

		// noi_cap
		$this->noi_cap->ViewValue = $this->noi_cap->CurrentValue;
		$this->noi_cap->ViewCustomAttributes = "";

		// ngay_cap
		$this->ngay_cap->ViewValue = $this->ngay_cap->CurrentValue;
		$this->ngay_cap->ViewValue = FormatDateTime($this->ngay_cap->ViewValue, 0);
		$this->ngay_cap->ViewCustomAttributes = "";

		// bo_phan_id
		$this->bo_phan_id->ViewValue = $this->bo_phan_id->CurrentValue;
		$this->bo_phan_id->ViewValue = FormatNumber($this->bo_phan_id->ViewValue, 0, -2, -2, -2);
		$this->bo_phan_id->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// userlevel
		if ($Security->canAdmin()) { // System admin
			$curVal = strval($this->_userlevel->CurrentValue);
			if ($curVal != "") {
				$this->_userlevel->ViewValue = $this->_userlevel->lookupCacheOption($curVal);
				if ($this->_userlevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->_userlevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->_userlevel->ViewValue = $this->_userlevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->_userlevel->ViewValue = $this->_userlevel->CurrentValue;
					}
				}
			} else {
				$this->_userlevel->ViewValue = NULL;
			}
		} else {
			$this->_userlevel->ViewValue = $Language->phrase("PasswordMask");
		}
		$this->_userlevel->ViewCustomAttributes = "";

		// nhan_vien_id
		$this->nhan_vien_id->LinkCustomAttributes = "";
		$this->nhan_vien_id->HrefValue = "";
		$this->nhan_vien_id->TooltipValue = "";

		// danh_so
		$this->danh_so->LinkCustomAttributes = "";
		$this->danh_so->HrefValue = "";
		$this->danh_so->TooltipValue = "";

		// ten_nhan_vien
		$this->ten_nhan_vien->LinkCustomAttributes = "";
		$this->ten_nhan_vien->HrefValue = "";
		$this->ten_nhan_vien->TooltipValue = "";

		// chuc_danh
		$this->chuc_danh->LinkCustomAttributes = "";
		$this->chuc_danh->HrefValue = "";
		$this->chuc_danh->TooltipValue = "";

		// luong
		$this->luong->LinkCustomAttributes = "";
		$this->luong->HrefValue = "";
		$this->luong->TooltipValue = "";

		// ngay_vao_dk
		$this->ngay_vao_dk->LinkCustomAttributes = "";
		$this->ngay_vao_dk->HrefValue = "";
		$this->ngay_vao_dk->TooltipValue = "";

		// ngay_vao_ld
		$this->ngay_vao_ld->LinkCustomAttributes = "";
		$this->ngay_vao_ld->HrefValue = "";
		$this->ngay_vao_ld->TooltipValue = "";

		// ngayll
		$this->ngayll->LinkCustomAttributes = "";
		$this->ngayll->HrefValue = "";
		$this->ngayll->TooltipValue = "";

		// ngay_sinh
		$this->ngay_sinh->LinkCustomAttributes = "";
		$this->ngay_sinh->HrefValue = "";
		$this->ngay_sinh->TooltipValue = "";

		// ncl1
		$this->ncl1->LinkCustomAttributes = "";
		$this->ncl1->HrefValue = "";
		$this->ncl1->TooltipValue = "";

		// ncl2
		$this->ncl2->LinkCustomAttributes = "";
		$this->ncl2->HrefValue = "";
		$this->ncl2->TooltipValue = "";

		// ncl3
		$this->ncl3->LinkCustomAttributes = "";
		$this->ncl3->HrefValue = "";
		$this->ncl3->TooltipValue = "";

		// DTCQ
		$this->DTCQ->LinkCustomAttributes = "";
		$this->DTCQ->HrefValue = "";
		$this->DTCQ->TooltipValue = "";

		// DTNR
		$this->DTNR->LinkCustomAttributes = "";
		$this->DTNR->HrefValue = "";
		$this->DTNR->TooltipValue = "";

		// DTDD
		$this->DTDD->LinkCustomAttributes = "";
		$this->DTDD->HrefValue = "";
		$this->DTDD->TooltipValue = "";

		// que_quan
		$this->que_quan->LinkCustomAttributes = "";
		$this->que_quan->HrefValue = "";
		$this->que_quan->TooltipValue = "";

		// dia_chi_noi_o
		$this->dia_chi_noi_o->LinkCustomAttributes = "";
		$this->dia_chi_noi_o->HrefValue = "";
		$this->dia_chi_noi_o->TooltipValue = "";

		// cmnd
		$this->cmnd->LinkCustomAttributes = "";
		$this->cmnd->HrefValue = "";
		$this->cmnd->TooltipValue = "";

		// noi_cap
		$this->noi_cap->LinkCustomAttributes = "";
		$this->noi_cap->HrefValue = "";
		$this->noi_cap->TooltipValue = "";

		// ngay_cap
		$this->ngay_cap->LinkCustomAttributes = "";
		$this->ngay_cap->HrefValue = "";
		$this->ngay_cap->TooltipValue = "";

		// bo_phan_id
		$this->bo_phan_id->LinkCustomAttributes = "";
		$this->bo_phan_id->HrefValue = "";
		$this->bo_phan_id->TooltipValue = "";

		// username
		$this->username->LinkCustomAttributes = "";
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// userlevel
		$this->_userlevel->LinkCustomAttributes = "";
		$this->_userlevel->HrefValue = "";
		$this->_userlevel->TooltipValue = "";

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

		// danh_so
		$this->danh_so->EditAttrs["class"] = "form-control";
		$this->danh_so->EditCustomAttributes = "";
		$this->danh_so->EditValue = $this->danh_so->CurrentValue;
		$this->danh_so->ViewCustomAttributes = "";

		// ten_nhan_vien
		$this->ten_nhan_vien->EditAttrs["class"] = "form-control";
		$this->ten_nhan_vien->EditCustomAttributes = "";
		$this->ten_nhan_vien->EditValue = $this->ten_nhan_vien->CurrentValue;
		$this->ten_nhan_vien->ViewCustomAttributes = "";

		// chuc_danh
		$this->chuc_danh->EditAttrs["class"] = "form-control";
		$this->chuc_danh->EditCustomAttributes = "";
		if (!$this->chuc_danh->Raw)
			$this->chuc_danh->CurrentValue = HtmlDecode($this->chuc_danh->CurrentValue);
		$this->chuc_danh->EditValue = $this->chuc_danh->CurrentValue;
		$this->chuc_danh->PlaceHolder = RemoveHtml($this->chuc_danh->caption());

		// luong
		$this->luong->EditAttrs["class"] = "form-control";
		$this->luong->EditCustomAttributes = "";
		$this->luong->EditValue = $this->luong->CurrentValue;
		$this->luong->PlaceHolder = RemoveHtml($this->luong->caption());

		// ngay_vao_dk
		$this->ngay_vao_dk->EditAttrs["class"] = "form-control";
		$this->ngay_vao_dk->EditCustomAttributes = "";
		$this->ngay_vao_dk->EditValue = FormatDateTime($this->ngay_vao_dk->CurrentValue, 8);
		$this->ngay_vao_dk->PlaceHolder = RemoveHtml($this->ngay_vao_dk->caption());

		// ngay_vao_ld
		$this->ngay_vao_ld->EditAttrs["class"] = "form-control";
		$this->ngay_vao_ld->EditCustomAttributes = "";
		$this->ngay_vao_ld->EditValue = FormatDateTime($this->ngay_vao_ld->CurrentValue, 8);
		$this->ngay_vao_ld->PlaceHolder = RemoveHtml($this->ngay_vao_ld->caption());

		// ngayll
		$this->ngayll->EditAttrs["class"] = "form-control";
		$this->ngayll->EditCustomAttributes = "";
		$this->ngayll->EditValue = FormatDateTime($this->ngayll->CurrentValue, 8);
		$this->ngayll->PlaceHolder = RemoveHtml($this->ngayll->caption());

		// ngay_sinh
		$this->ngay_sinh->EditAttrs["class"] = "form-control";
		$this->ngay_sinh->EditCustomAttributes = "";
		$this->ngay_sinh->EditValue = FormatDateTime($this->ngay_sinh->CurrentValue, 8);
		$this->ngay_sinh->PlaceHolder = RemoveHtml($this->ngay_sinh->caption());

		// ncl1
		$this->ncl1->EditAttrs["class"] = "form-control";
		$this->ncl1->EditCustomAttributes = "";
		$this->ncl1->EditValue = FormatDateTime($this->ncl1->CurrentValue, 8);
		$this->ncl1->PlaceHolder = RemoveHtml($this->ncl1->caption());

		// ncl2
		$this->ncl2->EditAttrs["class"] = "form-control";
		$this->ncl2->EditCustomAttributes = "";
		$this->ncl2->EditValue = FormatDateTime($this->ncl2->CurrentValue, 8);
		$this->ncl2->PlaceHolder = RemoveHtml($this->ncl2->caption());

		// ncl3
		$this->ncl3->EditAttrs["class"] = "form-control";
		$this->ncl3->EditCustomAttributes = "";
		$this->ncl3->EditValue = FormatDateTime($this->ncl3->CurrentValue, 8);
		$this->ncl3->PlaceHolder = RemoveHtml($this->ncl3->caption());

		// DTCQ
		$this->DTCQ->EditAttrs["class"] = "form-control";
		$this->DTCQ->EditCustomAttributes = "";
		if (!$this->DTCQ->Raw)
			$this->DTCQ->CurrentValue = HtmlDecode($this->DTCQ->CurrentValue);
		$this->DTCQ->EditValue = $this->DTCQ->CurrentValue;
		$this->DTCQ->PlaceHolder = RemoveHtml($this->DTCQ->caption());

		// DTNR
		$this->DTNR->EditAttrs["class"] = "form-control";
		$this->DTNR->EditCustomAttributes = "";
		if (!$this->DTNR->Raw)
			$this->DTNR->CurrentValue = HtmlDecode($this->DTNR->CurrentValue);
		$this->DTNR->EditValue = $this->DTNR->CurrentValue;
		$this->DTNR->PlaceHolder = RemoveHtml($this->DTNR->caption());

		// DTDD
		$this->DTDD->EditAttrs["class"] = "form-control";
		$this->DTDD->EditCustomAttributes = "";
		if (!$this->DTDD->Raw)
			$this->DTDD->CurrentValue = HtmlDecode($this->DTDD->CurrentValue);
		$this->DTDD->EditValue = $this->DTDD->CurrentValue;
		$this->DTDD->PlaceHolder = RemoveHtml($this->DTDD->caption());

		// que_quan
		$this->que_quan->EditAttrs["class"] = "form-control";
		$this->que_quan->EditCustomAttributes = "";
		if (!$this->que_quan->Raw)
			$this->que_quan->CurrentValue = HtmlDecode($this->que_quan->CurrentValue);
		$this->que_quan->EditValue = $this->que_quan->CurrentValue;
		$this->que_quan->PlaceHolder = RemoveHtml($this->que_quan->caption());

		// dia_chi_noi_o
		$this->dia_chi_noi_o->EditAttrs["class"] = "form-control";
		$this->dia_chi_noi_o->EditCustomAttributes = "";
		if (!$this->dia_chi_noi_o->Raw)
			$this->dia_chi_noi_o->CurrentValue = HtmlDecode($this->dia_chi_noi_o->CurrentValue);
		$this->dia_chi_noi_o->EditValue = $this->dia_chi_noi_o->CurrentValue;
		$this->dia_chi_noi_o->PlaceHolder = RemoveHtml($this->dia_chi_noi_o->caption());

		// cmnd
		$this->cmnd->EditAttrs["class"] = "form-control";
		$this->cmnd->EditCustomAttributes = "";
		if (!$this->cmnd->Raw)
			$this->cmnd->CurrentValue = HtmlDecode($this->cmnd->CurrentValue);
		$this->cmnd->EditValue = $this->cmnd->CurrentValue;
		$this->cmnd->PlaceHolder = RemoveHtml($this->cmnd->caption());

		// noi_cap
		$this->noi_cap->EditAttrs["class"] = "form-control";
		$this->noi_cap->EditCustomAttributes = "";
		if (!$this->noi_cap->Raw)
			$this->noi_cap->CurrentValue = HtmlDecode($this->noi_cap->CurrentValue);
		$this->noi_cap->EditValue = $this->noi_cap->CurrentValue;
		$this->noi_cap->PlaceHolder = RemoveHtml($this->noi_cap->caption());

		// ngay_cap
		$this->ngay_cap->EditAttrs["class"] = "form-control";
		$this->ngay_cap->EditCustomAttributes = "";
		$this->ngay_cap->EditValue = FormatDateTime($this->ngay_cap->CurrentValue, 8);
		$this->ngay_cap->PlaceHolder = RemoveHtml($this->ngay_cap->caption());

		// bo_phan_id
		$this->bo_phan_id->EditAttrs["class"] = "form-control";
		$this->bo_phan_id->EditCustomAttributes = "";
		$this->bo_phan_id->EditValue = $this->bo_phan_id->CurrentValue;
		$this->bo_phan_id->PlaceHolder = RemoveHtml($this->bo_phan_id->caption());

		// username
		$this->username->EditAttrs["class"] = "form-control";
		$this->username->EditCustomAttributes = "";
		if (!$this->username->Raw)
			$this->username->CurrentValue = HtmlDecode($this->username->CurrentValue);
		$this->username->EditValue = $this->username->CurrentValue;
		$this->username->PlaceHolder = RemoveHtml($this->username->caption());

		// password
		$this->password->EditAttrs["class"] = "form-control";
		$this->password->EditCustomAttributes = "";
		if (!$this->password->Raw)
			$this->password->CurrentValue = HtmlDecode($this->password->CurrentValue);
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->PlaceHolder = RemoveHtml($this->password->caption());

		// userlevel
		$this->_userlevel->EditAttrs["class"] = "form-control";
		$this->_userlevel->EditCustomAttributes = "";
		if (!$Security->canAdmin()) { // System admin
			$this->_userlevel->EditValue = $Language->phrase("PasswordMask");
		} else {
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
					$doc->exportCaption($this->danh_so);
					$doc->exportCaption($this->ten_nhan_vien);
					$doc->exportCaption($this->chuc_danh);
					$doc->exportCaption($this->luong);
					$doc->exportCaption($this->ngay_vao_dk);
					$doc->exportCaption($this->ngay_vao_ld);
					$doc->exportCaption($this->ngayll);
					$doc->exportCaption($this->ngay_sinh);
					$doc->exportCaption($this->ncl1);
					$doc->exportCaption($this->ncl2);
					$doc->exportCaption($this->ncl3);
					$doc->exportCaption($this->DTCQ);
					$doc->exportCaption($this->DTNR);
					$doc->exportCaption($this->DTDD);
					$doc->exportCaption($this->que_quan);
					$doc->exportCaption($this->dia_chi_noi_o);
					$doc->exportCaption($this->cmnd);
					$doc->exportCaption($this->noi_cap);
					$doc->exportCaption($this->ngay_cap);
					$doc->exportCaption($this->bo_phan_id);
					$doc->exportCaption($this->username);
					$doc->exportCaption($this->password);
					$doc->exportCaption($this->_userlevel);
				} else {
					$doc->exportCaption($this->nhan_vien_id);
					$doc->exportCaption($this->danh_so);
					$doc->exportCaption($this->ten_nhan_vien);
					$doc->exportCaption($this->chuc_danh);
					$doc->exportCaption($this->luong);
					$doc->exportCaption($this->ngay_vao_dk);
					$doc->exportCaption($this->ngay_vao_ld);
					$doc->exportCaption($this->ngayll);
					$doc->exportCaption($this->ngay_sinh);
					$doc->exportCaption($this->ncl1);
					$doc->exportCaption($this->ncl2);
					$doc->exportCaption($this->ncl3);
					$doc->exportCaption($this->DTCQ);
					$doc->exportCaption($this->DTNR);
					$doc->exportCaption($this->DTDD);
					$doc->exportCaption($this->que_quan);
					$doc->exportCaption($this->dia_chi_noi_o);
					$doc->exportCaption($this->cmnd);
					$doc->exportCaption($this->noi_cap);
					$doc->exportCaption($this->ngay_cap);
					$doc->exportCaption($this->bo_phan_id);
					$doc->exportCaption($this->username);
					$doc->exportCaption($this->password);
					$doc->exportCaption($this->_userlevel);
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
						$doc->exportField($this->danh_so);
						$doc->exportField($this->ten_nhan_vien);
						$doc->exportField($this->chuc_danh);
						$doc->exportField($this->luong);
						$doc->exportField($this->ngay_vao_dk);
						$doc->exportField($this->ngay_vao_ld);
						$doc->exportField($this->ngayll);
						$doc->exportField($this->ngay_sinh);
						$doc->exportField($this->ncl1);
						$doc->exportField($this->ncl2);
						$doc->exportField($this->ncl3);
						$doc->exportField($this->DTCQ);
						$doc->exportField($this->DTNR);
						$doc->exportField($this->DTDD);
						$doc->exportField($this->que_quan);
						$doc->exportField($this->dia_chi_noi_o);
						$doc->exportField($this->cmnd);
						$doc->exportField($this->noi_cap);
						$doc->exportField($this->ngay_cap);
						$doc->exportField($this->bo_phan_id);
						$doc->exportField($this->username);
						$doc->exportField($this->password);
						$doc->exportField($this->_userlevel);
					} else {
						$doc->exportField($this->nhan_vien_id);
						$doc->exportField($this->danh_so);
						$doc->exportField($this->ten_nhan_vien);
						$doc->exportField($this->chuc_danh);
						$doc->exportField($this->luong);
						$doc->exportField($this->ngay_vao_dk);
						$doc->exportField($this->ngay_vao_ld);
						$doc->exportField($this->ngayll);
						$doc->exportField($this->ngay_sinh);
						$doc->exportField($this->ncl1);
						$doc->exportField($this->ncl2);
						$doc->exportField($this->ncl3);
						$doc->exportField($this->DTCQ);
						$doc->exportField($this->DTNR);
						$doc->exportField($this->DTDD);
						$doc->exportField($this->que_quan);
						$doc->exportField($this->dia_chi_noi_o);
						$doc->exportField($this->cmnd);
						$doc->exportField($this->noi_cap);
						$doc->exportField($this->ngay_cap);
						$doc->exportField($this->bo_phan_id);
						$doc->exportField($this->username);
						$doc->exportField($this->password);
						$doc->exportField($this->_userlevel);
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

	// User ID filter
	public function getUserIDFilter($userId)
	{
		$userIdFilter = '`nhan_vien_id` = ' . QuotedValue($userId, DATATYPE_NUMBER, Config("USER_TABLE_DBID"));
		return $userIdFilter;
	}

	// Add User ID filter
	public function addUserIDFilter($filter = "", $id = "")
	{
		global $Security;
		$filterWrk = "";
		if ($id == "")
			$id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
		if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
			$filterWrk = $Security->userIdList();
			if ($filterWrk != "")
				$filterWrk = '`nhan_vien_id` IN (' . $filterWrk . ')';
		}

		// Call User ID Filtering event
		$this->UserID_Filtering($filterWrk);
		AddFilter($filter, $filterWrk);
		return $filter;
	}

	// User ID subquery
	public function getUserIDSubquery(&$fld, &$masterfld)
	{
		global $UserTable;
		$wrk = "";
		$sql = "SELECT " . $masterfld->Expression . " FROM `nhan_vien`";
		$filter = $this->addUserIDFilter("");
		if ($filter != "")
			$sql .= " WHERE " . $filter;

		// Use subquery
		if (Config("USE_SUBQUERY_FOR_MASTER_USER_ID")) {
			$wrk = $sql;
		} else {

			// List all values
			if ($rs = Conn($UserTable->Dbid)->execute($sql)) {
				while (!$rs->EOF) {
					if ($wrk != "")
						$wrk .= ",";
					$wrk .= QuotedValue($rs->fields[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
					$rs->moveNext();
				}
				$rs->close();
			}
		}
		if ($wrk != "")
			$wrk = $fld->Expression . " IN (" . $wrk . ")";
		return $wrk;
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
		$temp=CurrentUserID();
		if($temp!=-1)    //user_id cua Admin -1
		{
			$sFilter = "nhan_vien_id=".$temp;
			AddFilter($filter, $sFilter);
		}
		$sFilter = "bo_phan_id=18";
		AddFilter($filter, $sFilter);
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