<?php namespace PHPMaker2020\projectCoKhi; ?>
<?php

/**
 * Table class for Report_new
 */
class Report_new extends ReportTable
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
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;

	// Export
	public $ExportDoc;

	// Fields
	public $nhan_vien_id;
	public $ngay_sua_chua;
	public $thoi_gian;
	public $noi_dung;
	public $so_don_hang_id;
	public $chuanloai_id;
	public $thiet_bi_id;
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
		$this->TableVar = 'Report_new';
		$this->TableName = 'Report_new';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`ck_view_nhatky`";
		$this->ReportSourceTable = 'ck_view_nhatky'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// nhan_vien_id
		$this->nhan_vien_id = new ReportField('Report_new', 'Report_new', 'x_nhan_vien_id', 'nhan_vien_id', '`nhan_vien_id`', '`nhan_vien_id`', 3, 11, -1, FALSE, '`nhan_vien_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->nhan_vien_id->GroupingFieldId = 1;
		$this->nhan_vien_id->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->nhan_vien_id->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->nhan_vien_id->GroupByType = "";
		$this->nhan_vien_id->GroupInterval = "0";
		$this->nhan_vien_id->GroupSql = "";
		$this->nhan_vien_id->Nullable = FALSE; // NOT NULL field
		$this->nhan_vien_id->Required = TRUE; // Required field
		$this->nhan_vien_id->Sortable = TRUE; // Allow sort
		$this->nhan_vien_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nhan_vien_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->nhan_vien_id->Lookup = new Lookup('nhan_vien_id', 'ck_view_nhan_vien_ck', FALSE, 'nhan_vien_id', ["ten_nhan_vien","","",""], [], [], [], [], [], [], '', '');
		$this->nhan_vien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->nhan_vien_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->nhan_vien_id->SourceTableVar = 'ck_view_nhatky';
		$this->fields['nhan_vien_id'] = &$this->nhan_vien_id;

		// ngay_sua_chua
		$this->ngay_sua_chua = new ReportField('Report_new', 'Report_new', 'x_ngay_sua_chua', 'ngay_sua_chua', '`ngay_sua_chua`', CastDateFieldForLike("`ngay_sua_chua`", 7, "DB"), 133, 10, 7, FALSE, '`ngay_sua_chua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_sua_chua->Sortable = TRUE; // Allow sort
		$this->ngay_sua_chua->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->ngay_sua_chua->SourceTableVar = 'ck_view_nhatky';
		$this->fields['ngay_sua_chua'] = &$this->ngay_sua_chua;

		// thoi_gian
		$this->thoi_gian = new ReportField('Report_new', 'Report_new', 'x_thoi_gian', 'thoi_gian', '`thoi_gian`', '`thoi_gian`', 3, 11, -1, FALSE, '`thoi_gian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->thoi_gian->Sortable = TRUE; // Allow sort
		$this->thoi_gian->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->thoi_gian->SourceTableVar = 'ck_view_nhatky';
		$this->fields['thoi_gian'] = &$this->thoi_gian;

		// noi_dung
		$this->noi_dung = new ReportField('Report_new', 'Report_new', 'x_noi_dung', 'noi_dung', '`noi_dung`', '`noi_dung`', 201, 1000, -1, FALSE, '`noi_dung`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->noi_dung->Sortable = TRUE; // Allow sort
		$this->noi_dung->SourceTableVar = 'ck_view_nhatky';
		$this->fields['noi_dung'] = &$this->noi_dung;

		// so_don_hang_id
		$this->so_don_hang_id = new ReportField('Report_new', 'Report_new', 'x_so_don_hang_id', 'so_don_hang_id', '`so_don_hang_id`', '`so_don_hang_id`', 200, 110, -1, FALSE, '`so_don_hang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->so_don_hang_id->Nullable = FALSE; // NOT NULL field
		$this->so_don_hang_id->Required = TRUE; // Required field
		$this->so_don_hang_id->Sortable = TRUE; // Allow sort
		$this->so_don_hang_id->SourceTableVar = 'ck_view_nhatky';
		$this->fields['so_don_hang_id'] = &$this->so_don_hang_id;

		// chuanloai_id
		$this->chuanloai_id = new ReportField('Report_new', 'Report_new', 'x_chuanloai_id', 'chuanloai_id', '`chuanloai_id`', '`chuanloai_id`', 3, 11, -1, FALSE, '`chuanloai_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->chuanloai_id->Sortable = TRUE; // Allow sort
		$this->chuanloai_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->chuanloai_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->chuanloai_id->Lookup = new Lookup('chuanloai_id', 'ck_chungloai_thietbi', FALSE, 'chungloai_id', ["ten_chungloai","","",""], [], ["x_thiet_bi_id"], [], [], [], [], '', '');
		$this->chuanloai_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->chuanloai_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->chuanloai_id->SourceTableVar = 'ck_view_nhatky';
		$this->fields['chuanloai_id'] = &$this->chuanloai_id;

		// thiet_bi_id
		$this->thiet_bi_id = new ReportField('Report_new', 'Report_new', 'x_thiet_bi_id', 'thiet_bi_id', '`thiet_bi_id`', '`thiet_bi_id`', 3, 11, -1, FALSE, '`thiet_bi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->thiet_bi_id->Nullable = FALSE; // NOT NULL field
		$this->thiet_bi_id->Required = TRUE; // Required field
		$this->thiet_bi_id->Sortable = TRUE; // Allow sort
		$this->thiet_bi_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->thiet_bi_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->thiet_bi_id->Lookup = new Lookup('thiet_bi_id', 'ck_danhmuc_thietbi', FALSE, 'thiet_bi_id', ["ky_ma_hieu","","",""], ["x_chuanloai_id"], [], ["chung_loai_id"], ["x_chung_loai_id"], [], [], '', '');
		$this->thiet_bi_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->thiet_bi_id->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->thiet_bi_id->SourceTableVar = 'ck_view_nhatky';
		$this->fields['thiet_bi_id'] = &$this->thiet_bi_id;

		// ngay_hoan_thanh
		$this->ngay_hoan_thanh = new ReportField('Report_new', 'Report_new', 'x_ngay_hoan_thanh', 'ngay_hoan_thanh', '`ngay_hoan_thanh`', CastDateFieldForLike("`ngay_hoan_thanh`", 0, "DB"), 133, 10, 0, FALSE, '`ngay_hoan_thanh`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ngay_hoan_thanh->Nullable = FALSE; // NOT NULL field
		$this->ngay_hoan_thanh->Required = TRUE; // Required field
		$this->ngay_hoan_thanh->Sortable = TRUE; // Allow sort
		$this->ngay_hoan_thanh->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->ngay_hoan_thanh->SourceTableVar = 'ck_view_nhatky';
		$this->fields['ngay_hoan_thanh'] = &$this->ngay_hoan_thanh;

		// baoduong_dinhky
		$this->baoduong_dinhky = new ReportField('Report_new', 'Report_new', 'x_baoduong_dinhky', 'baoduong_dinhky', '`baoduong_dinhky`', '`baoduong_dinhky`', 16, 1, -1, FALSE, '`baoduong_dinhky`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->baoduong_dinhky->Sortable = TRUE; // Allow sort
		$this->baoduong_dinhky->DataType = DATATYPE_BOOLEAN;
		$this->baoduong_dinhky->Lookup = new Lookup('baoduong_dinhky', 'Report_new', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->baoduong_dinhky->OptionCount = 2;
		$this->baoduong_dinhky->DefaultErrorMessage = $Language->phrase("IncorrectField");
		$this->baoduong_dinhky->AdvancedSearch->SearchValueDefault = INIT_VALUE;
		$this->baoduong_dinhky->SourceTableVar = 'ck_view_nhatky';
		$this->fields['baoduong_dinhky'] = &$this->baoduong_dinhky;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
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
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->nhan_vien_id;
		$expr = $firstGroupField->Expression;
		if ($firstGroupField->GroupSql != "") {
			$expr = str_replace("%s", $firstGroupField->Expression, $firstGroupField->GroupSql);
			if ($alias)
				$expr .= " AS " . QuotedName($firstGroupField->getGroupName(), $this->Dbid);
		}
		return $expr;
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup != "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField(TRUE) . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		if ($this->_sqlOrderByGroup != "")
			return $this->_sqlOrderByGroup;
		return $this->getSqlFirstGroupField() . " ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix != "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix != "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount != "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Render for lookup
	public function renderLookup()
	{
		$this->nhan_vien_id->ViewValue = GetDropDownDisplayValue($this->nhan_vien_id->CurrentValue, "", 0);
		$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->CurrentValue, 7);
		$this->so_don_hang_id->ViewValue = $this->so_don_hang_id->CurrentValue;
		$this->chuanloai_id->ViewValue = GetDropDownDisplayValue($this->chuanloai_id->CurrentValue, "", 0);
		$this->thiet_bi_id->ViewValue = GetDropDownDisplayValue($this->thiet_bi_id->CurrentValue, "", 0);
		$this->baoduong_dinhky->ViewValue = GetDropDownDisplayValue($this->baoduong_dinhky->CurrentValue, "boolean", 0);
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
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
		$groupField = &$this->nhan_vien_id;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		return "SELECT " . $select . " FROM " . $this->getSqlFrom();
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`ngay_sua_chua` ASC";
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
			return "";
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
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("", $this->getUrlParm($parm));
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
		return $this->keyUrl("", $this->getUrlParm());
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
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
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

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
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