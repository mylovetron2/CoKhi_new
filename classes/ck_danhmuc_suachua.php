<?php namespace PHPMaker2020\projectCoKhi; ?>
<?php

/**
 * Table class for ck_danhmuc_suachua
 */
class ck_danhmuc_suachua extends DbTable
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
	public $sua_chua_id;
	public $chuanloai_id;
	public $thiet_bi_id;
	public $ngay_sua_chua;
	public $noi_dung_sua_chua;
	public $thoi_gian_sua_chua;
	public $nguoi_nhap_lieu;
	public $dich_vu;
	public $hoan_thanh;
	public $ghi_chu;
	public $id_don_hang;
	public $ngay_hoan_thanh;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ck_danhmuc_suachua';
		$this->TableName = 'ck_danhmuc_suachua';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`ck_danhmuc_suachua`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// sua_chua_id
		$this->sua_chua_id = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_sua_chua_id', 'sua_chua_id', '`sua_chua_id`', '`sua_chua_id`', 3, 11, -1, FALSE, '`sua_chua_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sua_chua_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->sua_chua_id->IsPrimaryKey = TRUE; // Primary key field
		$this->sua_chua_id->IsForeignKey = TRUE; // Foreign key field
		$this->sua_chua_id->Sortable = FALSE; // Allow sort
		$this->sua_chua_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sua_chua_id'] = &$this->sua_chua_id;

		// chuanloai_id
		$this->chuanloai_id = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_chuanloai_id', 'chuanloai_id', '`chuanloai_id`', '`chuanloai_id`', 3, 11, -1, FALSE, '`chuanloai_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->chuanloai_id->Sortable = FALSE; // Allow sort
		$this->chuanloai_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->chuanloai_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->chuanloai_id->Lookup = new Lookup('chuanloai_id', 'ck_chungloai_thietbi', FALSE, 'chungloai_id', ["ten_chungloai","","",""], [], ["x_thiet_bi_id"], [], [], [], [], '', '');
		$this->chuanloai_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['chuanloai_id'] = &$this->chuanloai_id;

		// thiet_bi_id
		$this->thiet_bi_id = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_thiet_bi_id', 'thiet_bi_id', '`thiet_bi_id`', '`thiet_bi_id`', 3, 11, -1, FALSE, '`thiet_bi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->thiet_bi_id->Nullable = FALSE; // NOT NULL field
		$this->thiet_bi_id->Required = TRUE; // Required field
		$this->thiet_bi_id->Sortable = FALSE; // Allow sort
		$this->thiet_bi_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->thiet_bi_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->thiet_bi_id->Lookup = new Lookup('thiet_bi_id', 'ck_danhmuc_thietbi', TRUE, 'thiet_bi_id', ["ky_ma_hieu","","",""], ["x_chuanloai_id"], [], ["chung_loai_id"], ["x_chung_loai_id"], [], [], '', '');
		$this->thiet_bi_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['thiet_bi_id'] = &$this->thiet_bi_id;

		// ngay_sua_chua
		$this->ngay_sua_chua = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_ngay_sua_chua', 'ngay_sua_chua', '`ngay_sua_chua`', CastDateFieldForLike("`ngay_sua_chua`", 14, "DB"), 133, 10, 14, FALSE, '`ngay_sua_chua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_sua_chua->Nullable = FALSE; // NOT NULL field
		$this->ngay_sua_chua->Required = TRUE; // Required field
		$this->ngay_sua_chua->Sortable = FALSE; // Allow sort
		$this->ngay_sua_chua->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectShortDateDMY"));
		$this->fields['ngay_sua_chua'] = &$this->ngay_sua_chua;

		// noi_dung_sua_chua
		$this->noi_dung_sua_chua = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_noi_dung_sua_chua', 'noi_dung_sua_chua', '`noi_dung_sua_chua`', '`noi_dung_sua_chua`', 201, 500, -1, FALSE, '`noi_dung_sua_chua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->noi_dung_sua_chua->Nullable = FALSE; // NOT NULL field
		$this->noi_dung_sua_chua->Required = TRUE; // Required field
		$this->noi_dung_sua_chua->Sortable = FALSE; // Allow sort
		$this->fields['noi_dung_sua_chua'] = &$this->noi_dung_sua_chua;

		// thoi_gian_sua_chua
		$this->thoi_gian_sua_chua = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_thoi_gian_sua_chua', 'thoi_gian_sua_chua', '`thoi_gian_sua_chua`', '`thoi_gian_sua_chua`', 4, 12, -1, FALSE, '`thoi_gian_sua_chua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->thoi_gian_sua_chua->Sortable = FALSE; // Allow sort
		$this->thoi_gian_sua_chua->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['thoi_gian_sua_chua'] = &$this->thoi_gian_sua_chua;

		// nguoi_nhap_lieu
		$this->nguoi_nhap_lieu = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_nguoi_nhap_lieu', 'nguoi_nhap_lieu', '`nguoi_nhap_lieu`', '`nguoi_nhap_lieu`', 3, 11, -1, FALSE, '`nguoi_nhap_lieu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->nguoi_nhap_lieu->Sortable = FALSE; // Allow sort
		$this->nguoi_nhap_lieu->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nguoi_nhap_lieu->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->nguoi_nhap_lieu->Lookup = new Lookup('nguoi_nhap_lieu', 'nhan_vien', TRUE, 'nhan_vien_id', ["ten_nhan_vien","","",""], [], [], [], [], [], [], '', '');
		$this->nguoi_nhap_lieu->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nguoi_nhap_lieu'] = &$this->nguoi_nhap_lieu;

		// dich_vu
		$this->dich_vu = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_dich_vu', 'dich_vu', '`dich_vu`', '`dich_vu`', 16, 1, -1, FALSE, '`dich_vu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->dich_vu->Sortable = FALSE; // Allow sort
		$this->dich_vu->DataType = DATATYPE_BOOLEAN;
		$this->dich_vu->Lookup = new Lookup('dich_vu', 'ck_danhmuc_suachua', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->dich_vu->OptionCount = 2;
		$this->fields['dich_vu'] = &$this->dich_vu;

		// hoan_thanh
		$this->hoan_thanh = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_hoan_thanh', 'hoan_thanh', '`hoan_thanh`', '`hoan_thanh`', 16, 1, -1, FALSE, '`hoan_thanh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->hoan_thanh->Nullable = FALSE; // NOT NULL field
		$this->hoan_thanh->Sortable = FALSE; // Allow sort
		$this->hoan_thanh->DataType = DATATYPE_BOOLEAN;
		$this->hoan_thanh->Lookup = new Lookup('hoan_thanh', 'ck_danhmuc_suachua', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->hoan_thanh->OptionCount = 2;
		$this->hoan_thanh->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->fields['hoan_thanh'] = &$this->hoan_thanh;

		// ghi_chu
		$this->ghi_chu = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_ghi_chu', 'ghi_chu', '`ghi_chu`', '`ghi_chu`', 201, 1000, -1, FALSE, '`ghi_chu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->ghi_chu->Sortable = FALSE; // Allow sort
		$this->fields['ghi_chu'] = &$this->ghi_chu;

		// id_don_hang
		$this->id_don_hang = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_id_don_hang', 'id_don_hang', '`id_don_hang`', '`id_don_hang`', 3, 11, -1, FALSE, '`EV__id_don_hang`', TRUE, FALSE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->id_don_hang->IsForeignKey = TRUE; // Foreign key field
		$this->id_don_hang->Nullable = FALSE; // NOT NULL field
		$this->id_don_hang->Required = TRUE; // Required field
		$this->id_don_hang->Sortable = FALSE; // Allow sort
		$this->id_don_hang->Lookup = new Lookup('id_don_hang', 'ck_don_hang', FALSE, 'id', ["so_don_hang_id","","",""], [], [], [], [], [], [], '', '');
		$this->id_don_hang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_don_hang'] = &$this->id_don_hang;

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh = new DbField('ck_danhmuc_suachua', 'ck_danhmuc_suachua', 'x_ngay_hoan_thanh', 'ngay_hoan_thanh', '`ngay_hoan_thanh`', CastDateFieldForLike("`ngay_hoan_thanh`", 7, "DB"), 133, 10, 7, FALSE, '`ngay_hoan_thanh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_hoan_thanh->Sortable = TRUE; // Allow sort
		$this->ngay_hoan_thanh->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['ngay_hoan_thanh'] = &$this->ngay_hoan_thanh;
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
		if ($this->getCurrentMasterTable() == "ck_don_hang") {
			if ($this->id_don_hang->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->id_don_hang->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "ck_don_hang") {
			if ($this->id_don_hang->getSessionValue() != "")
				$detailFilter .= "`id_don_hang`=" . QuotedValue($this->id_don_hang->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_ck_don_hang()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_ck_don_hang()
	{
		return "`id_don_hang`=@id_don_hang@";
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
		if ($this->getCurrentDetailTable() == "ck_chitiet_suachua") {
			$detailUrl = $GLOBALS["ck_chitiet_suachua"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_sua_chua_id=" . urlencode($this->sua_chua_id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "ck_danhmuc_suachualist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`ck_danhmuc_suachua`";
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
			"SELECT *, (SELECT `so_don_hang_id` FROM `ck_don_hang` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`id` = `ck_danhmuc_suachua`.`id_don_hang` LIMIT 1) AS `EV__id_don_hang` FROM `ck_danhmuc_suachua`" .
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
		if ($this->id_don_hang->AdvancedSearch->SearchValue != "" ||
			$this->id_don_hang->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->id_don_hang->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->id_don_hang->VirtualExpression . " "))
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
			$this->sua_chua_id->setDbValue($conn->insert_ID());
			$rs['sua_chua_id'] = $this->sua_chua_id->DbValue;
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
			if (array_key_exists('sua_chua_id', $rs))
				AddFilter($where, QuotedName('sua_chua_id', $this->Dbid) . '=' . QuotedValue($rs['sua_chua_id'], $this->sua_chua_id->DataType, $this->Dbid));
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
		$this->sua_chua_id->DbValue = $row['sua_chua_id'];
		$this->chuanloai_id->DbValue = $row['chuanloai_id'];
		$this->thiet_bi_id->DbValue = $row['thiet_bi_id'];
		$this->ngay_sua_chua->DbValue = $row['ngay_sua_chua'];
		$this->noi_dung_sua_chua->DbValue = $row['noi_dung_sua_chua'];
		$this->thoi_gian_sua_chua->DbValue = $row['thoi_gian_sua_chua'];
		$this->nguoi_nhap_lieu->DbValue = $row['nguoi_nhap_lieu'];
		$this->dich_vu->DbValue = $row['dich_vu'];
		$this->hoan_thanh->DbValue = $row['hoan_thanh'];
		$this->ghi_chu->DbValue = $row['ghi_chu'];
		$this->id_don_hang->DbValue = $row['id_don_hang'];
		$this->ngay_hoan_thanh->DbValue = $row['ngay_hoan_thanh'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`sua_chua_id` = @sua_chua_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('sua_chua_id', $row) ? $row['sua_chua_id'] : NULL;
		else
			$val = $this->sua_chua_id->OldValue !== NULL ? $this->sua_chua_id->OldValue : $this->sua_chua_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@sua_chua_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "ck_danhmuc_suachualist.php";
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
		if ($pageName == "ck_danhmuc_suachuaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ck_danhmuc_suachuaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ck_danhmuc_suachuaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ck_danhmuc_suachualist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ck_danhmuc_suachuaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_danhmuc_suachuaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ck_danhmuc_suachuaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ck_danhmuc_suachuaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ck_danhmuc_suachuaedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_danhmuc_suachuaedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("ck_danhmuc_suachuaadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ck_danhmuc_suachuaadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("ck_danhmuc_suachuadelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "ck_don_hang" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->id_don_hang->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "sua_chua_id:" . JsonEncode($this->sua_chua_id->CurrentValue, "number");
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
		if ($this->sua_chua_id->CurrentValue != NULL) {
			$url .= "sua_chua_id=" . urlencode($this->sua_chua_id->CurrentValue);
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
			if (Param("sua_chua_id") !== NULL)
				$arKeys[] = Param("sua_chua_id");
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
				$this->sua_chua_id->CurrentValue = $key;
			else
				$this->sua_chua_id->OldValue = $key;
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
		$this->sua_chua_id->setDbValue($rs->fields('sua_chua_id'));
		$this->chuanloai_id->setDbValue($rs->fields('chuanloai_id'));
		$this->thiet_bi_id->setDbValue($rs->fields('thiet_bi_id'));
		$this->ngay_sua_chua->setDbValue($rs->fields('ngay_sua_chua'));
		$this->noi_dung_sua_chua->setDbValue($rs->fields('noi_dung_sua_chua'));
		$this->thoi_gian_sua_chua->setDbValue($rs->fields('thoi_gian_sua_chua'));
		$this->nguoi_nhap_lieu->setDbValue($rs->fields('nguoi_nhap_lieu'));
		$this->dich_vu->setDbValue($rs->fields('dich_vu'));
		$this->hoan_thanh->setDbValue($rs->fields('hoan_thanh'));
		$this->ghi_chu->setDbValue($rs->fields('ghi_chu'));
		$this->id_don_hang->setDbValue($rs->fields('id_don_hang'));
		$this->ngay_hoan_thanh->setDbValue($rs->fields('ngay_hoan_thanh'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// sua_chua_id
		// chuanloai_id
		// thiet_bi_id
		// ngay_sua_chua
		// noi_dung_sua_chua
		// thoi_gian_sua_chua
		// nguoi_nhap_lieu
		// dich_vu
		// hoan_thanh
		// ghi_chu
		// id_don_hang
		// ngay_hoan_thanh
		// sua_chua_id

		$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
		$this->sua_chua_id->ViewCustomAttributes = "";

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

		// ngay_sua_chua
		$this->ngay_sua_chua->ViewValue = $this->ngay_sua_chua->CurrentValue;
		$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->ViewValue, 14);
		$this->ngay_sua_chua->ViewCustomAttributes = "";

		// noi_dung_sua_chua
		$this->noi_dung_sua_chua->ViewValue = $this->noi_dung_sua_chua->CurrentValue;
		$this->noi_dung_sua_chua->ViewCustomAttributes = "";

		// thoi_gian_sua_chua
		$this->thoi_gian_sua_chua->ViewValue = $this->thoi_gian_sua_chua->CurrentValue;
		$this->thoi_gian_sua_chua->ViewValue = FormatNumber($this->thoi_gian_sua_chua->ViewValue, 2, -2, -2, -2);
		$this->thoi_gian_sua_chua->ViewCustomAttributes = "";

		// nguoi_nhap_lieu
		$curVal = strval($this->nguoi_nhap_lieu->CurrentValue);
		if ($curVal != "") {
			$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->lookupCacheOption($curVal);
			if ($this->nguoi_nhap_lieu->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
				$lookupFilter = function() {
					return "`bo_phan_id`=18";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->nguoi_nhap_lieu->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn("diavatly")->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->CurrentValue;
				}
			}
		} else {
			$this->nguoi_nhap_lieu->ViewValue = NULL;
		}
		$this->nguoi_nhap_lieu->ViewCustomAttributes = "";

		// dich_vu
		if (ConvertToBool($this->dich_vu->CurrentValue)) {
			$this->dich_vu->ViewValue = $this->dich_vu->tagCaption(1) != "" ? $this->dich_vu->tagCaption(1) : "Yes";
		} else {
			$this->dich_vu->ViewValue = $this->dich_vu->tagCaption(2) != "" ? $this->dich_vu->tagCaption(2) : "No";
		}
		$this->dich_vu->ViewCustomAttributes = "";

		// hoan_thanh
		if (ConvertToBool($this->hoan_thanh->CurrentValue)) {
			$this->hoan_thanh->ViewValue = $this->hoan_thanh->tagCaption(1) != "" ? $this->hoan_thanh->tagCaption(1) : "Yes";
		} else {
			$this->hoan_thanh->ViewValue = $this->hoan_thanh->tagCaption(2) != "" ? $this->hoan_thanh->tagCaption(2) : "No";
		}
		$this->hoan_thanh->ViewCustomAttributes = "";

		// ghi_chu
		$this->ghi_chu->ViewValue = $this->ghi_chu->CurrentValue;
		$this->ghi_chu->ViewCustomAttributes = "";

		// id_don_hang
		if ($this->id_don_hang->VirtualValue != "") {
			$this->id_don_hang->ViewValue = $this->id_don_hang->VirtualValue;
		} else {
			$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
			$curVal = strval($this->id_don_hang->CurrentValue);
			if ($curVal != "") {
				$this->id_don_hang->ViewValue = $this->id_don_hang->lookupCacheOption($curVal);
				if ($this->id_don_hang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_don_hang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_don_hang->ViewValue = $this->id_don_hang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
					}
				}
			} else {
				$this->id_don_hang->ViewValue = NULL;
			}
		}
		$this->id_don_hang->ViewCustomAttributes = "";

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh->ViewValue = $this->ngay_hoan_thanh->CurrentValue;
		$this->ngay_hoan_thanh->ViewValue = FormatDateTime($this->ngay_hoan_thanh->ViewValue, 7);
		$this->ngay_hoan_thanh->ViewCustomAttributes = "";

		// sua_chua_id
		$this->sua_chua_id->LinkCustomAttributes = "";
		$this->sua_chua_id->HrefValue = "";
		$this->sua_chua_id->TooltipValue = "";

		// chuanloai_id
		$this->chuanloai_id->LinkCustomAttributes = "";
		$this->chuanloai_id->HrefValue = "";
		$this->chuanloai_id->TooltipValue = "";

		// thiet_bi_id
		$this->thiet_bi_id->LinkCustomAttributes = "";
		$this->thiet_bi_id->HrefValue = "";
		$this->thiet_bi_id->TooltipValue = "";

		// ngay_sua_chua
		$this->ngay_sua_chua->LinkCustomAttributes = "";
		$this->ngay_sua_chua->HrefValue = "";
		$this->ngay_sua_chua->TooltipValue = "";

		// noi_dung_sua_chua
		$this->noi_dung_sua_chua->LinkCustomAttributes = "";
		$this->noi_dung_sua_chua->HrefValue = "";
		$this->noi_dung_sua_chua->TooltipValue = "";

		// thoi_gian_sua_chua
		$this->thoi_gian_sua_chua->LinkCustomAttributes = "";
		$this->thoi_gian_sua_chua->HrefValue = "";
		$this->thoi_gian_sua_chua->TooltipValue = "";

		// nguoi_nhap_lieu
		$this->nguoi_nhap_lieu->LinkCustomAttributes = "";
		$this->nguoi_nhap_lieu->HrefValue = "";
		$this->nguoi_nhap_lieu->TooltipValue = "";

		// dich_vu
		$this->dich_vu->LinkCustomAttributes = "";
		$this->dich_vu->HrefValue = "";
		$this->dich_vu->TooltipValue = "";

		// hoan_thanh
		$this->hoan_thanh->LinkCustomAttributes = "";
		$this->hoan_thanh->HrefValue = "";
		$this->hoan_thanh->TooltipValue = "";

		// ghi_chu
		$this->ghi_chu->LinkCustomAttributes = "";
		$this->ghi_chu->HrefValue = "";
		$this->ghi_chu->TooltipValue = "";

		// id_don_hang
		$this->id_don_hang->LinkCustomAttributes = "";
		$this->id_don_hang->HrefValue = "";
		$this->id_don_hang->TooltipValue = "";

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh->LinkCustomAttributes = "";
		$this->ngay_hoan_thanh->HrefValue = "";
		$this->ngay_hoan_thanh->TooltipValue = "";

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

		// sua_chua_id
		$this->sua_chua_id->EditAttrs["class"] = "form-control";
		$this->sua_chua_id->EditCustomAttributes = "";
		$this->sua_chua_id->EditValue = $this->sua_chua_id->CurrentValue;
		$this->sua_chua_id->ViewCustomAttributes = "";

		// chuanloai_id
		$this->chuanloai_id->EditAttrs["class"] = "form-control";
		$this->chuanloai_id->EditCustomAttributes = "";

		// thiet_bi_id
		$this->thiet_bi_id->EditAttrs["class"] = "form-control";
		$this->thiet_bi_id->EditCustomAttributes = "";

		// ngay_sua_chua
		$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
		$this->ngay_sua_chua->EditCustomAttributes = "";
		$this->ngay_sua_chua->EditValue = FormatDateTime($this->ngay_sua_chua->CurrentValue, 14);
		$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());

		// noi_dung_sua_chua
		$this->noi_dung_sua_chua->EditAttrs["class"] = "form-control";
		$this->noi_dung_sua_chua->EditCustomAttributes = "";
		$this->noi_dung_sua_chua->EditValue = $this->noi_dung_sua_chua->CurrentValue;
		$this->noi_dung_sua_chua->PlaceHolder = RemoveHtml($this->noi_dung_sua_chua->caption());

		// thoi_gian_sua_chua
		$this->thoi_gian_sua_chua->EditAttrs["class"] = "form-control";
		$this->thoi_gian_sua_chua->EditCustomAttributes = "";
		$this->thoi_gian_sua_chua->EditValue = $this->thoi_gian_sua_chua->CurrentValue;
		$this->thoi_gian_sua_chua->PlaceHolder = RemoveHtml($this->thoi_gian_sua_chua->caption());
		if (strval($this->thoi_gian_sua_chua->EditValue) != "" && is_numeric($this->thoi_gian_sua_chua->EditValue))
			$this->thoi_gian_sua_chua->EditValue = FormatNumber($this->thoi_gian_sua_chua->EditValue, -2, -2, -2, -2);
		

		// nguoi_nhap_lieu
		$this->nguoi_nhap_lieu->EditAttrs["class"] = "form-control";
		$this->nguoi_nhap_lieu->EditCustomAttributes = "";

		// dich_vu
		$this->dich_vu->EditCustomAttributes = "";
		$this->dich_vu->EditValue = $this->dich_vu->options(FALSE);

		// hoan_thanh
		$this->hoan_thanh->EditCustomAttributes = "";
		$this->hoan_thanh->EditValue = $this->hoan_thanh->options(FALSE);

		// ghi_chu
		$this->ghi_chu->EditAttrs["class"] = "form-control";
		$this->ghi_chu->EditCustomAttributes = "";
		$this->ghi_chu->EditValue = $this->ghi_chu->CurrentValue;
		$this->ghi_chu->PlaceHolder = RemoveHtml($this->ghi_chu->caption());

		// id_don_hang
		$this->id_don_hang->EditAttrs["class"] = "form-control";
		$this->id_don_hang->EditCustomAttributes = "";
		if ($this->id_don_hang->getSessionValue() != "") {
			$this->id_don_hang->CurrentValue = $this->id_don_hang->getSessionValue();
			if ($this->id_don_hang->VirtualValue != "") {
				$this->id_don_hang->ViewValue = $this->id_don_hang->VirtualValue;
			} else {
				$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
				$curVal = strval($this->id_don_hang->CurrentValue);
				if ($curVal != "") {
					$this->id_don_hang->ViewValue = $this->id_don_hang->lookupCacheOption($curVal);
					if ($this->id_don_hang->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->id_don_hang->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->id_don_hang->ViewValue = $this->id_don_hang->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
						}
					}
				} else {
					$this->id_don_hang->ViewValue = NULL;
				}
			}
			$this->id_don_hang->ViewCustomAttributes = "";
		} else {
			$this->id_don_hang->EditValue = $this->id_don_hang->CurrentValue;
			$this->id_don_hang->PlaceHolder = RemoveHtml($this->id_don_hang->caption());
		}

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh->EditAttrs["class"] = "form-control";
		$this->ngay_hoan_thanh->EditCustomAttributes = "";
		$this->ngay_hoan_thanh->EditValue = FormatDateTime($this->ngay_hoan_thanh->CurrentValue, 7);
		$this->ngay_hoan_thanh->PlaceHolder = RemoveHtml($this->ngay_hoan_thanh->caption());

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
					$doc->exportCaption($this->chuanloai_id);
					$doc->exportCaption($this->thiet_bi_id);
					$doc->exportCaption($this->ngay_sua_chua);
					$doc->exportCaption($this->noi_dung_sua_chua);
					$doc->exportCaption($this->thoi_gian_sua_chua);
					$doc->exportCaption($this->nguoi_nhap_lieu);
					$doc->exportCaption($this->dich_vu);
					$doc->exportCaption($this->hoan_thanh);
					$doc->exportCaption($this->ghi_chu);
					$doc->exportCaption($this->id_don_hang);
					$doc->exportCaption($this->ngay_hoan_thanh);
				} else {
					$doc->exportCaption($this->sua_chua_id);
					$doc->exportCaption($this->ngay_hoan_thanh);
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
						$doc->exportField($this->chuanloai_id);
						$doc->exportField($this->thiet_bi_id);
						$doc->exportField($this->ngay_sua_chua);
						$doc->exportField($this->noi_dung_sua_chua);
						$doc->exportField($this->thoi_gian_sua_chua);
						$doc->exportField($this->nguoi_nhap_lieu);
						$doc->exportField($this->dich_vu);
						$doc->exportField($this->hoan_thanh);
						$doc->exportField($this->ghi_chu);
						$doc->exportField($this->id_don_hang);
						$doc->exportField($this->ngay_hoan_thanh);
					} else {
						$doc->exportField($this->sua_chua_id);
						$doc->exportField($this->ngay_hoan_thanh);
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

		/*
		$rsnew["so_gio_do"]=$GLOBALS["chuoi_may"]->so_gio_do->CurrentValue;
		$rsnew["ngay"]=$GLOBALS["chuoi_may"]->ngay->CurrentValue;
		$rsnew["gian_khoan"]=$GLOBALS["chuoi_may"]->gian_khoan->CurrentValue;
		if($GLOBALS["chuoi_may"]->ap_suat_cao->CurrentValue=="")
			$rsnew["ap_suat_cao"]=0;
		else 
			$rsnew["ap_suat_cao"]="".$GLOBALS["chuoi_may"]->ap_suat_cao->CurrentValue;
		if($GLOBALS["chuoi_may"]->H2S->CurrentValue=="")
			$rsnew["h2s"]=0;
		else
			$rsnew["h2s"]=$GLOBALS["chuoi_may"]->H2S->CurrentValue;
			*/
		$rsnew["ngay_sua_chua"]=$GLOBALS["ck_don_hang"]->ngay_sua_chua->CurrentValue;
		$rsnew["noi_dung_sua_chua"]=$GLOBALS["ck_don_hang"]->noi_dung_sua_chua->CurrentValue;
		$rsnew["thoi_gian_sua_chua"]=$GLOBALS["ck_don_hang"]->thoi_gian_sua_chua->CurrentValue;
		$rsnew["so_don_hang_id"]=$GLOBALS["ck_don_hang"]->so_don_hang_id->CurrentValue;
		$rsnew["nguoi_nhap_lieu"]=$GLOBALS["ck_don_hang"]->nguoi_nhap_lieu->CurrentValue;
	if($GLOBALS["ck_don_hang"]->dich_vu->CurrentValue=="")
		$rsnew["dich_vu"]=0;
	else
		$rsnew["dich_vu"]=$GLOBALS["ck_don_hang"]->dich_vu->CurrentValue;
	if($GLOBALS["ck_don_hang"]->hoan_thanh->CurrentValue=="")
		$rsnew["hoan_thanh"]=0;
	else
		$rsnew["hoan_thanh"]=$GLOBALS["ck_don_hang"]->hoan_thanh->CurrentValue;

		//$rsnew["noi_dung_sua_chua"]="Test";
		//$rsnew["thoi_gian_sua_chua"]=4;
		//$rsnew["so_don_hang_id"]=123;

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

		/*		
		$rsnew["ngay_sua_chua"]=$GLOBALS["ck_don_hang"]->ngay_sua_chua->CurrentValue;
		$rsnew["noi_dung_sua_chua"]=$GLOBALS["ck_don_hang"]->noi_dung_sua_chua->CurrentValue;
		$rsnew["thoi_gian_sua_chua"]=$GLOBALS["ck_don_hang"]->thoi_gian_sua_chua->CurrentValue;
		$rsnew["so_don_hang_id"]=$GLOBALS["ck_don_hang"]->so_don_hang_id->CurrentValue;
		$rsnew["nguoi_nhap_lieu"]=$GLOBALS["ck_don_hang"]->nguoi_nhap_lieu->CurrentValue;
		$rsnew["dich_vu"]=$GLOBALS["ck_don_hang"]->dich_vu->CurrentValue;
		$rsnew["hoan_thanh"]=$GLOBALS["ck_don_hang"]->hoan_thanh->CurrentValue;
		*/

	/*
		$rsnew["ngay_sua_chua"]=$GLOBALS["ck_don_hang"]->ngay_sua_chua->CurrentValue;
		$rsnew["noi_dung_sua_chua"]=$GLOBALS["ck_don_hang"]->noi_dung_sua_chua->CurrentValue;
		$rsnew["thoi_gian_sua_chua"]=$GLOBALS["ck_don_hang"]->thoi_gian_sua_chua->CurrentValue;
		$rsnew["so_don_hang_id"]=$GLOBALS["ck_don_hang"]->so_don_hang_id->CurrentValue;
		$rsnew["nguoi_nhap_lieu"]=$GLOBALS["ck_don_hang"]->nguoi_nhap_lieu->CurrentValue;
	if($GLOBALS["ck_don_hang"]->dich_vu->CurrentValue=="")
		$rsnew["dich_vu"]=0;
	else
		$rsnew["dich_vu"]=$GLOBALS["ck_don_hang"]->dich_vu->CurrentValue;
	if($GLOBALS["ck_don_hang"]->hoan_thanh->CurrentValue=="")
		$rsnew["hoan_thanh"]=0;
	else
		$rsnew["hoan_thanh"]=$GLOBALS["ck_don_hang"]->hoan_thanh->CurrentValue;
		*/
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
		$rsnew = $this->GetGridFormValues(); // Get the form values of the new records as an array of array

		//var_dump($rsnew); die(); // Print the records and end the script
		$add = '';
		$addTenChungLoai='';
		$temp='';
		$chungloai='';
		$tenchungloai='';
		$temptenchungloai='';
		foreach ($rsnew as $row){ // Loop through the new records
			$state_row = ExecuteRow("SELECT * FROM ck_danhmuc_thietbi WHERE thiet_bi_id=".$row["thiet_bi_id"]);
			$temp=$state_row["ky_ma_hieu"];
			$chungloai=$state_row["chung_loai_id"];
			$tenchungloai=ExecuteScalar("SELECT ten_chungloai FROM ck_chungloai_thietbi WHERE chungloai_id=".$chungloai);
			if($temp!=''){
				if($add==''){
					$add = $temp;
					$addTenChungLoai=$tenchungloai;
				}
				else
				{
					$add = $add.', '.$temp;

					//$addTenChungLoai=$addTenChungLoai.', '.$tenchungloai; //Chỉ add cái đầu tiên
				}
			}
		}
		Execute("UPDATE ck_don_hang SET ten_thiet_bi='".$add."',chung_loai='".$addTenChungLoai."' WHERE id=".$GLOBALS["ck_don_hang"]->id->CurrentValue);	
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

		/*
			//echo "Grid Inserted";
		$rsnew = $this->GetGridFormValues(); // Get the form values of the new records as an array of array
		//var_dump($rsnew); die(); // Print the records and end the script
		$add = '';
		$addTenChungLoai='';
		$temp='';
		$chungloai='';
		$tenchungloai='';
		$temptenchungloai='';
		foreach ($rsnew as $row){ // Loop through the new records
			$state_row = ExecuteRow("SELECT * FROM ck_danhmuc_thietbi WHERE thiet_bi_id=".$row["thiet_bi_id"]);
			$temp=$state_row["ky_ma_hieu"];
			$chungloai=$state_row["chung_loai_id"];
			$tenchungloai=ExecuteScalar("SELECT ten_chungloai FROM ck_chungloai_thietbi WHERE chungloai_id=".$chungloai);
			if($temp!=''){
				if($add==''){
					$add = $temp;
					$addTenChungLoai=$tenchungloai;
				}
				else
				{
					$add = $add.', '.$temp;
					//$addTenChungLoai=$addTenChungLoai.', '.$tenchungloai; //Chỉ add cái đầu tiên
				}
			}
		}
		Execute("UPDATE ck_don_hang SET ten_thiet_bi='".$add."',chung_loai='".$addTenChungLoai."' WHERE id=".$GLOBALS["ck_don_hang"]->id->CurrentValue);	
		*/
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
		//$temp=ExecuteScalar("SELECT chung_loai_id FROM ck_danhmuc_thietbi WHERE thiet_bi_id='".$this->thiet_bi_id->CurrentValue."'");
		//$this->chungloai->CurrentValue=$temp;
		//$this->chungloai->Value=$temp;

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);
		//$temp=ExecuteScalar("SELECT chung_loai_id FROM ck_danhmuc_thietbi WHERE thiet_bi_id='".$this->thiet_bi_id->CurrentValue."'");
		//$this->chungloai->ViewValue=ExecuteScalar("SELECT chungloai_id FROM ck_danhmuc_thietbi WHERE thiet_bi_id=".$this->thiet_bi_id->CurrentValue."");
		//$this->chungloai->ViewValue=$temp;

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>