<?php
namespace PHPMaker2020\projectCoKhi;

/**
 * Page class
 */
class Report_new_summary extends Report_new
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{5DCEF576-624A-4686-A415-DE69CC04A397}";

	// Table name
	public $TableName = 'Report_new';

	// Page object name
	public $PageObjName = "Report_new_summary";

	// CSS
	public $ReportTableClass = "";
	public $ReportTableStyle = "";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (Report_new)
		if (!isset($GLOBALS["Report_new"]) || get_class($GLOBALS["Report_new"]) == PROJECT_NAMESPACE . "Report_new") {
			$GLOBALS["Report_new"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Report_new"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";

		// Table object (nhan_vien)
		if (!isset($GLOBALS['nhan_vien']))
			$GLOBALS['nhan_vien'] = new nhan_vien();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'summary');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Report_new');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (nhan_vien)
		$UserTable = $UserTable ?: new nhan_vien();

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fsummary";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->isExport() && !$this->isExport("print") && $fn = Config("REPORT_EXPORT_FUNCTIONS." . $this->Export)) {
			$content = ob_get_clean();
			$this->$fn($content);
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection if not in dashboard
		if (!$DashboardReport)
			CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}

		// Exit if not in dashboard
		if (!$DashboardReport)
			exit();
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;
		if (in_array($lookup->LinkTable, [$this->ReportSourceTable, $this->TableVar]))
			$lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
		$lookup->RenderEditFunc = ""; // Set up edit renderer

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}

	// Initialize common variables
	public $HideOptions = FALSE;
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $FilterOptions; // Filter options

	// Records
	public $GroupRecords = [];
	public $DetailRecords = [];
	public $DetailRecordCount = 0;

	// Paging variables
	public $RecordIndex = 0; // Record index
	public $RecordCount = 0; // Record count (start from 1 for each group)
	public $StartGroup = 0; // Start group
	public $StopGroup = 0; // Stop group
	public $TotalGroups = 0; // Total groups
	public $GroupCount = 0; // Group count
	public $GroupCounter = []; // Group counter
	public $DisplayGroups = 3; // Groups per page
	public $GroupRange = 10;
	public $PageSizes = "1,2,3,5,-1"; // Page sizes (comma separated)
	public $Sort = "";
	public $Filter = "";
	public $PageFirstGroupFilter = "";
	public $UserIDFilter = "";
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = "";
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $DrillDownList = "";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $SearchCommand = FALSE;
	public $ShowHeader;
	public $GroupColumnCount = 0;
	public $SubGroupColumnCount = 0;
	public $DetailColumnCount = 0;
	public $TotalCount;
	public $PageTotalCount;
	public $TopContentClass = "col-sm-12 ew-top";
	public $LeftContentClass = "ew-left";
	public $CenterContentClass = "col-sm-12 ew-center";
	public $RightContentClass = "ew-right";
	public $BottomContentClass = "col-sm-12 ew-bottom";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $ExportFileName, $Language, $Security, $UserProfile,
			$Security, $FormError, $DrillDownInPanel, $Breadcrumb,
			$DashboardReport, $CustomExportType, $ReportExportType;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canReport()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up table class
		if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf"))
			$this->ReportTableClass = "ew-table";
		else
			$this->ReportTableClass = "table ew-table";

		// Set field visibility for detail fields
		$this->ngay_sua_chua->setVisibility();
		$this->thoi_gian->setVisibility();
		$this->noi_dung->setVisibility();
		$this->so_don_hang_id->setVisibility();
		$this->chuanloai_id->setVisibility();
		$this->thiet_bi_id->setVisibility();
		$this->ngay_hoan_thanh->setVisibility();
		$this->baoduong_dinhky->setVisibility();

		// Set up groups per page dynamically
		$this->setupDisplayGroups();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Check if search command
		$this->SearchCommand = (Get("cmd", "") == "search");

		// Load custom filters
		$this->Page_FilterLoad();

		// Extended filter
		$extendedFilter = "";

		// Restore filter list
		$this->restoreFilterList();

		// Build extended filter
		$extendedFilter = $this->getExtendedFilter();
		AddFilter($this->SearchWhere, $extendedFilter);

		// Call Page Selecting event
		$this->Page_Selecting($this->SearchWhere);

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Get sort
		$this->Sort = $this->getSort();

		// Update filter
		AddFilter($this->Filter, $this->SearchWhere);

		// Get total group count
		$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
		$this->TotalGroups = $this->getRecordCount($sql);
		if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) // Display all groups
			$this->DisplayGroups = $this->TotalGroups;
		$this->StartGroup = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGroups > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->isExport())
			$this->DisplayGroups = $this->TotalGroups;
		else
			$this->setupStartGroup();

		// Set no record found message
		if ($this->TotalGroups == 0) {
			if ($Security->canList()) {
				if ($this->SearchWhere == "0=101") {
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($Language->phrase("NoRecord"));
				}
			} else {
				$this->setWarningMessage(DeniedMessage());
			}
		}

		// Hide export options if export/dashboard report/hide options
		if ($this->isExport() || $DashboardReport || $this->HideOptions)
			$this->ExportOptions->hideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report/hide options
		if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}

		// Get group records
		if ($this->TotalGroups > 0) {
			$grpSort = UpdateSortFields($this->getSqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
			$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderByGroup(), $this->Filter, $grpSort);
			$grpRs = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);
			$this->GroupRecords = $grpRs->getRows(); // Get records of first grouping field
			$this->loadGroupRowValues();
			$this->GroupCount = 1;
		}

		// Init detail records
		$this->DetailRecords = [];
		$this->setupFieldCount();

		// Set the last group to display if not export all
		if ($this->ExportAll && $this->isExport()) {
			$this->StopGroup = $this->TotalGroups;
		} else {
			$this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
		}

		// Stop group <= total number of groups
		if (intval($this->StopGroup) > intval($this->TotalGroups))
			$this->StopGroup = $this->TotalGroups;
		$this->RecordCount = 0;
		$this->RecordIndex = 0;

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Load group row values
	public function loadGroupRowValues()
	{
		$cnt = count($this->GroupRecords); // Get record count
		if ($this->GroupCount < $cnt)
			$this->nhan_vien_id->setGroupValue($this->GroupRecords[$this->GroupCount][0]);
		else
			$this->nhan_vien_id->setGroupValue("");
	}

	// Load row values
	public function loadRowValues($record)
	{
		if ($this->RecordIndex == 1) { // Load first row data
			$data = [];
			$data["nhan_vien_id"] = $record['nhan_vien_id'];
			$data["ngay_sua_chua"] = $record['ngay_sua_chua'];
			$data["thoi_gian"] = $record['thoi_gian'];
			$data["so_don_hang_id"] = $record['so_don_hang_id'];
			$data["chuanloai_id"] = $record['chuanloai_id'];
			$data["thiet_bi_id"] = $record['thiet_bi_id'];
			$data["ngay_hoan_thanh"] = $record['ngay_hoan_thanh'];
			$data["baoduong_dinhky"] = $record['baoduong_dinhky'];
			$this->Rows[] = $data;
		}
		$this->nhan_vien_id->setDbValue(GroupValue($this->nhan_vien_id, $record['nhan_vien_id']));
		$this->ngay_sua_chua->setDbValue($record['ngay_sua_chua']);
		$this->thoi_gian->setDbValue($record['thoi_gian']);
		$this->noi_dung->setDbValue($record['noi_dung']);
		$this->so_don_hang_id->setDbValue($record['so_don_hang_id']);
		$this->chuanloai_id->setDbValue($record['chuanloai_id']);
		$this->thiet_bi_id->setDbValue($record['thiet_bi_id']);
		$this->ngay_hoan_thanh->setDbValue($record['ngay_hoan_thanh']);
		$this->baoduong_dinhky->setDbValue($record['baoduong_dinhky']);
	}

	// Render row
	public function renderRow()
	{
		global $Security, $Language, $Language;
		$conn = $this->getConnection();
		if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total

			// Build detail SQL
			$firstGrpFld = &$this->nhan_vien_id;
			$firstGrpFld->getDistinctValues($this->GroupRecords);
			$where = DetailFilterSql($firstGrpFld, $this->getSqlFirstGroupField(), $firstGrpFld->DistinctValues, $this->Dbid);
			if ($this->Filter != "")
				$where = "($this->Filter) AND ($where)";
			$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $where, $this->Sort);
			$rs = $this->getRecordset($sql);
			$records = $rs ? $rs->getRows() : [];
			$this->PageTotalCount = count($records);
		} elseif ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_GRAND) { // Get Grand total
			$hasCount = FALSE;
			$hasSummary = FALSE;

			// Get total count from SQL directly
			$sql = BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->execute($sql);
			if ($rstot) {
				$cnt = ($rstot->recordCount() > 1) ? $rstot->recordCount() : $rstot->fields[0];
				$rstot->close();
				$hasCount = TRUE;
			} else {
				$cnt = 0;
			}
			$this->TotalCount = $cnt;
			$hasSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $this->getRecordset($sql);
				$this->DetailRecords = $rs ? $rs->getRows() : [];
			}
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		// nhan_vien_id
		// ngay_sua_chua
		// thoi_gian
		// noi_dung
		// so_don_hang_id
		// chuanloai_id
		// thiet_bi_id
		// ngay_hoan_thanh
		// baoduong_dinhky

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// nhan_vien_id
			$this->nhan_vien_id->EditAttrs["class"] = "form-control";
			$this->nhan_vien_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->nhan_vien_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->nhan_vien_id->AdvancedSearch->ViewValue = $this->nhan_vien_id->lookupCacheOption($curVal);
			else
				$this->nhan_vien_id->AdvancedSearch->ViewValue = $this->nhan_vien_id->Lookup !== NULL && is_array($this->nhan_vien_id->Lookup->Options) ? $curVal : NULL;
			if ($this->nhan_vien_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->nhan_vien_id->EditValue = array_values($this->nhan_vien_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $this->nhan_vien_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->nhan_vien_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->nhan_vien_id->EditValue = $arwrk;
			}

			// ngay_sua_chua
			$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
			$this->ngay_sua_chua->EditCustomAttributes = "";
			$this->ngay_sua_chua->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ngay_sua_chua->AdvancedSearch->SearchValue, 7), 7));
			$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());
			$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
			$this->ngay_sua_chua->EditCustomAttributes = "";
			$this->ngay_sua_chua->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ngay_sua_chua->AdvancedSearch->SearchValue2, 7), 7));
			$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());

			// so_don_hang_id
			$this->so_don_hang_id->EditAttrs["class"] = "form-control";
			$this->so_don_hang_id->EditCustomAttributes = "";
			if (!$this->so_don_hang_id->Raw)
				$this->so_don_hang_id->AdvancedSearch->SearchValue = HtmlDecode($this->so_don_hang_id->AdvancedSearch->SearchValue);
			$this->so_don_hang_id->EditValue = HtmlEncode($this->so_don_hang_id->AdvancedSearch->SearchValue);
			$this->so_don_hang_id->PlaceHolder = RemoveHtml($this->so_don_hang_id->caption());

			// chuanloai_id
			$this->chuanloai_id->EditAttrs["class"] = "form-control";
			$this->chuanloai_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->chuanloai_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->chuanloai_id->AdvancedSearch->ViewValue = $this->chuanloai_id->lookupCacheOption($curVal);
			else
				$this->chuanloai_id->AdvancedSearch->ViewValue = $this->chuanloai_id->Lookup !== NULL && is_array($this->chuanloai_id->Lookup->Options) ? $curVal : NULL;
			if ($this->chuanloai_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->chuanloai_id->EditValue = array_values($this->chuanloai_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`chungloai_id`" . SearchString("=", $this->chuanloai_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->chuanloai_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->chuanloai_id->EditValue = $arwrk;
			}

			// thiet_bi_id
			$this->thiet_bi_id->EditAttrs["class"] = "form-control";
			$this->thiet_bi_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->thiet_bi_id->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->thiet_bi_id->AdvancedSearch->ViewValue = $this->thiet_bi_id->lookupCacheOption($curVal);
			else
				$this->thiet_bi_id->AdvancedSearch->ViewValue = $this->thiet_bi_id->Lookup !== NULL && is_array($this->thiet_bi_id->Lookup->Options) ? $curVal : NULL;
			if ($this->thiet_bi_id->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->thiet_bi_id->EditValue = array_values($this->thiet_bi_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`thiet_bi_id`" . SearchString("=", $this->thiet_bi_id->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->thiet_bi_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->thiet_bi_id->EditValue = $arwrk;
			}

			// baoduong_dinhky
			$this->baoduong_dinhky->EditCustomAttributes = "";
			$this->baoduong_dinhky->EditValue = $this->baoduong_dinhky->options(FALSE);
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP)
				$this->RowAttrs["data-group"] = $this->nhan_vien_id->groupValue(); // Set up group attribute

			// nhan_vien_id
			$curVal = strval($this->nhan_vien_id->groupValue());
			if ($curVal != "") {
				$this->nhan_vien_id->GroupViewValue = $this->nhan_vien_id->lookupCacheOption($curVal);
				if ($this->nhan_vien_id->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->nhan_vien_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->nhan_vien_id->GroupViewValue = $this->nhan_vien_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nhan_vien_id->GroupViewValue = $this->nhan_vien_id->groupValue();
					}
				}
			} else {
				$this->nhan_vien_id->GroupViewValue = NULL;
			}
			$this->nhan_vien_id->CellCssClass = ($this->RowGroupLevel == 1 ? "ew-rpt-grp-summary-1" : "ew-rpt-grp-field-1");
			$this->nhan_vien_id->ViewCustomAttributes = "";
			$this->nhan_vien_id->GroupViewValue = DisplayGroupValue($this->nhan_vien_id, $this->nhan_vien_id->GroupViewValue);
			if (!$this->nhan_vien_id->LevelBreak) {
			 	if ($this->nhan_vien_id->ShowCompactSummaryFooter)
					$this->nhan_vien_id->GroupViewValue = "&nbsp;";
			} else
				$this->nhan_vien_id->LevelBreak = false;

			// nhan_vien_id
			$this->nhan_vien_id->HrefValue = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->HrefValue = "";

			// thoi_gian
			$this->thoi_gian->HrefValue = "";

			// noi_dung
			$this->noi_dung->HrefValue = "";

			// so_don_hang_id
			$this->so_don_hang_id->HrefValue = "";

			// chuanloai_id
			$this->chuanloai_id->HrefValue = "";

			// thiet_bi_id
			$this->thiet_bi_id->HrefValue = "";

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->HrefValue = "";

			// baoduong_dinhky
			$this->baoduong_dinhky->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->nhan_vien_id->groupValue(); // Set up group attribute
			} else {
			$this->RowAttrs["data-group"] = $this->nhan_vien_id->groupValue(); // Set up group attribute
			}

			// nhan_vien_id
			$curVal = strval($this->nhan_vien_id->groupValue());
			if ($curVal != "") {
				$this->nhan_vien_id->GroupViewValue = $this->nhan_vien_id->lookupCacheOption($curVal);
				if ($this->nhan_vien_id->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->nhan_vien_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->nhan_vien_id->GroupViewValue = $this->nhan_vien_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nhan_vien_id->GroupViewValue = $this->nhan_vien_id->groupValue();
					}
				}
			} else {
				$this->nhan_vien_id->GroupViewValue = NULL;
			}
			$this->nhan_vien_id->CellCssClass = "ew-rpt-grp-field-1";
			$this->nhan_vien_id->ViewCustomAttributes = "";
			$this->nhan_vien_id->GroupViewValue = DisplayGroupValue($this->nhan_vien_id, $this->nhan_vien_id->GroupViewValue);
			if (!$this->nhan_vien_id->LevelBreak)
				$this->nhan_vien_id->GroupViewValue = "&nbsp;";
			else
				$this->nhan_vien_id->LevelBreak = FALSE;

			// ngay_sua_chua
			$this->ngay_sua_chua->ViewValue = $this->ngay_sua_chua->CurrentValue;
			$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->ViewValue, 7);
			$this->ngay_sua_chua->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->ngay_sua_chua->ViewCustomAttributes = "";

			// thoi_gian
			$this->thoi_gian->ViewValue = $this->thoi_gian->CurrentValue;
			$this->thoi_gian->ViewValue = FormatNumber($this->thoi_gian->ViewValue, 0, -2, -2, -2);
			$this->thoi_gian->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->thoi_gian->ViewCustomAttributes = "";

			// noi_dung
			$this->noi_dung->ViewValue = $this->noi_dung->CurrentValue;
			$this->noi_dung->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->noi_dung->ViewCustomAttributes = "";

			// so_don_hang_id
			$this->so_don_hang_id->ViewValue = $this->so_don_hang_id->CurrentValue;
			$this->so_don_hang_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->so_don_hang_id->ViewCustomAttributes = "";

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
			$this->chuanloai_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
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
			$this->thiet_bi_id->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->thiet_bi_id->ViewCustomAttributes = "";

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->ViewValue = $this->ngay_hoan_thanh->CurrentValue;
			$this->ngay_hoan_thanh->ViewValue = FormatDateTime($this->ngay_hoan_thanh->ViewValue, 0);
			$this->ngay_hoan_thanh->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->ngay_hoan_thanh->ViewCustomAttributes = "";

			// baoduong_dinhky
			if (ConvertToBool($this->baoduong_dinhky->CurrentValue)) {
				$this->baoduong_dinhky->ViewValue = $this->baoduong_dinhky->tagCaption(1) != "" ? $this->baoduong_dinhky->tagCaption(1) : "Yes";
			} else {
				$this->baoduong_dinhky->ViewValue = $this->baoduong_dinhky->tagCaption(2) != "" ? $this->baoduong_dinhky->tagCaption(2) : "No";
			}
			$this->baoduong_dinhky->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
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

			// so_don_hang_id
			$this->so_don_hang_id->LinkCustomAttributes = "";
			$this->so_don_hang_id->HrefValue = "";
			$this->so_don_hang_id->TooltipValue = "";

			// chuanloai_id
			$this->chuanloai_id->LinkCustomAttributes = "";
			$this->chuanloai_id->HrefValue = "";
			$this->chuanloai_id->TooltipValue = "";

			// thiet_bi_id
			$this->thiet_bi_id->LinkCustomAttributes = "";
			$this->thiet_bi_id->HrefValue = "";
			$this->thiet_bi_id->TooltipValue = "";

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->LinkCustomAttributes = "";
			$this->ngay_hoan_thanh->HrefValue = "";
			$this->ngay_hoan_thanh->TooltipValue = "";

			// baoduong_dinhky
			$this->baoduong_dinhky->LinkCustomAttributes = "";
			$this->baoduong_dinhky->HrefValue = "";
			$this->baoduong_dinhky->TooltipValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row

			// nhan_vien_id
			$currentValue = $this->nhan_vien_id->GroupViewValue;
			$viewValue = &$this->nhan_vien_id->GroupViewValue;
			$viewAttrs = &$this->nhan_vien_id->ViewAttrs;
			$cellAttrs = &$this->nhan_vien_id->CellAttrs;
			$hrefValue = &$this->nhan_vien_id->HrefValue;
			$linkAttrs = &$this->nhan_vien_id->LinkAttrs;
			$this->Cell_Rendered($this->nhan_vien_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// nhan_vien_id
			$currentValue = $this->nhan_vien_id->groupValue();
			$viewValue = &$this->nhan_vien_id->GroupViewValue;
			$viewAttrs = &$this->nhan_vien_id->ViewAttrs;
			$cellAttrs = &$this->nhan_vien_id->CellAttrs;
			$hrefValue = &$this->nhan_vien_id->HrefValue;
			$linkAttrs = &$this->nhan_vien_id->LinkAttrs;
			$this->Cell_Rendered($this->nhan_vien_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ngay_sua_chua
			$currentValue = $this->ngay_sua_chua->CurrentValue;
			$viewValue = &$this->ngay_sua_chua->ViewValue;
			$viewAttrs = &$this->ngay_sua_chua->ViewAttrs;
			$cellAttrs = &$this->ngay_sua_chua->CellAttrs;
			$hrefValue = &$this->ngay_sua_chua->HrefValue;
			$linkAttrs = &$this->ngay_sua_chua->LinkAttrs;
			$this->Cell_Rendered($this->ngay_sua_chua, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// thoi_gian
			$currentValue = $this->thoi_gian->CurrentValue;
			$viewValue = &$this->thoi_gian->ViewValue;
			$viewAttrs = &$this->thoi_gian->ViewAttrs;
			$cellAttrs = &$this->thoi_gian->CellAttrs;
			$hrefValue = &$this->thoi_gian->HrefValue;
			$linkAttrs = &$this->thoi_gian->LinkAttrs;
			$this->Cell_Rendered($this->thoi_gian, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// noi_dung
			$currentValue = $this->noi_dung->CurrentValue;
			$viewValue = &$this->noi_dung->ViewValue;
			$viewAttrs = &$this->noi_dung->ViewAttrs;
			$cellAttrs = &$this->noi_dung->CellAttrs;
			$hrefValue = &$this->noi_dung->HrefValue;
			$linkAttrs = &$this->noi_dung->LinkAttrs;
			$this->Cell_Rendered($this->noi_dung, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// so_don_hang_id
			$currentValue = $this->so_don_hang_id->CurrentValue;
			$viewValue = &$this->so_don_hang_id->ViewValue;
			$viewAttrs = &$this->so_don_hang_id->ViewAttrs;
			$cellAttrs = &$this->so_don_hang_id->CellAttrs;
			$hrefValue = &$this->so_don_hang_id->HrefValue;
			$linkAttrs = &$this->so_don_hang_id->LinkAttrs;
			$this->Cell_Rendered($this->so_don_hang_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// chuanloai_id
			$currentValue = $this->chuanloai_id->CurrentValue;
			$viewValue = &$this->chuanloai_id->ViewValue;
			$viewAttrs = &$this->chuanloai_id->ViewAttrs;
			$cellAttrs = &$this->chuanloai_id->CellAttrs;
			$hrefValue = &$this->chuanloai_id->HrefValue;
			$linkAttrs = &$this->chuanloai_id->LinkAttrs;
			$this->Cell_Rendered($this->chuanloai_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// thiet_bi_id
			$currentValue = $this->thiet_bi_id->CurrentValue;
			$viewValue = &$this->thiet_bi_id->ViewValue;
			$viewAttrs = &$this->thiet_bi_id->ViewAttrs;
			$cellAttrs = &$this->thiet_bi_id->CellAttrs;
			$hrefValue = &$this->thiet_bi_id->HrefValue;
			$linkAttrs = &$this->thiet_bi_id->LinkAttrs;
			$this->Cell_Rendered($this->thiet_bi_id, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ngay_hoan_thanh
			$currentValue = $this->ngay_hoan_thanh->CurrentValue;
			$viewValue = &$this->ngay_hoan_thanh->ViewValue;
			$viewAttrs = &$this->ngay_hoan_thanh->ViewAttrs;
			$cellAttrs = &$this->ngay_hoan_thanh->CellAttrs;
			$hrefValue = &$this->ngay_hoan_thanh->HrefValue;
			$linkAttrs = &$this->ngay_hoan_thanh->LinkAttrs;
			$this->Cell_Rendered($this->ngay_hoan_thanh, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// baoduong_dinhky
			$currentValue = $this->baoduong_dinhky->CurrentValue;
			$viewValue = &$this->baoduong_dinhky->ViewValue;
			$viewAttrs = &$this->baoduong_dinhky->ViewAttrs;
			$cellAttrs = &$this->baoduong_dinhky->CellAttrs;
			$hrefValue = &$this->baoduong_dinhky->HrefValue;
			$linkAttrs = &$this->baoduong_dinhky->LinkAttrs;
			$this->Cell_Rendered($this->baoduong_dinhky, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->setupFieldCount();
	}
	private $_groupCounts = [];

	// Get group count
	public function getGroupCount(...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "") {
			return -1;
		} elseif ($key == "0") { // Number of first level groups
			$i = 1;
			while (isset($this->_groupCounts[strval($i)]))
				$i++;
			return $i - 1;
		}
		return isset($this->_groupCounts[$key]) ? $this->_groupCounts[$key] : -1;
	}

	// Set group count
	public function setGroupCount($value, ...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "")
			return;
		$this->_groupCounts[$key] = $value;
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->nhan_vien_id->Visible)
			$this->GroupColumnCount += 1;
		if ($this->ngay_sua_chua->Visible)
			$this->DetailColumnCount += 1;
		if ($this->thoi_gian->Visible)
			$this->DetailColumnCount += 1;
		if ($this->noi_dung->Visible)
			$this->DetailColumnCount += 1;
		if ($this->so_don_hang_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->chuanloai_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->thiet_bi_id->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ngay_hoan_thanh->Visible)
			$this->DetailColumnCount += 1;
		if ($this->baoduong_dinhky->Visible)
			$this->DetailColumnCount += 1;
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			return '<a class="ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportExcelUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToExcel") . '</a>';
		} elseif (SameText($type, "word")) {
			return '<a class="ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportWordUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToWord") . '</a>';
		} elseif (SameText($type, "pdf")) {
			return '<a class="ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportPdfUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToPDF") . '</a>';
		} elseif (SameText($type, "email")) {
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_Report_new" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_Report_new\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = FALSE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fsummary\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_nhan_vien_id":
					break;
				case "x_chuanloai_id":
					break;
				case "x_thiet_bi_id":
					break;
				case "x_baoduong_dinhky":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_nhan_vien_id":
							break;
						case "x_chuanloai_id":
							break;
						case "x_thiet_bi_id":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

// Export PDF
	public function exportReportPdf($html)
	{
		global $ExportFileName;
		@ini_set("memory_limit", Config("PDF_MEMORY_LIMIT"));
		set_time_limit(Config("PDF_TIME_LIMIT"));
		$html = CheckHtml($html);
		if (Config("DEBUG")) // Add debug message
			$html = str_replace("</body>", GetDebugMessage() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(["pdf_backend" => "CPDF"]);
		$doc = new \DOMDocument("1.0", "utf-8");
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			$classNames = $span->getAttribute("class");
			if ($classNames == "ew-filter-caption") // Insert colon
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
			elseif (preg_match('/\bicon\-\w+\b/', $classNames)) // Remove icons
				$span->parentNode->removeChild($span);
		}
		$images = $doc->getElementsByTagName("img");
		$pageSize = $this->ExportPageSize;
		$pageOrientation = $this->ExportPageOrientation;
		$portrait = SameText($pageOrientation, "portrait");
		foreach ($images as $image) {
			$imagefn = $image->getAttribute("src");
			if (file_exists($imagefn)) {
				$imagefn = realpath($imagefn);
				$size = getimagesize($imagefn); // Get image size
				if ($size[0] != 0) {
					if (SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
						$w = $portrait ? 216 : 279;
					} elseif (SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
						$w = $portrait ? 216 : 356;
					} else {
						$w = $portrait ? 210 : 297; // A4 paper (210 mm by 297 mm)
					}
					$w = min($size[0], ($w - 20 * 2) / 25.4 * 72 * Config("PDF_IMAGE_SCALE_FACTOR")); // Resize image, adjust the scale factor if necessary
					$h = $w / $size[0] * $size[1];
					$image->setAttribute("width", $w);
					$image->setAttribute("height", $h);
				}
			}
		}
		$html = $doc->saveHTML();
		$html = ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper($pageSize, $pageOrientation);
		$dompdf->render();
		header('Set-Cookie: fileDownload=true; path=/');
		$exportFile = EndsText(".pdf", $ExportFileName) ? $ExportFileName : $ExportFileName . ".pdf";
		$dompdf->stream($exportFile, ["Attachment" => 1]); // 0 to open in browser, 1 to download
		DeleteTempImages();
		exit();
	}

	// Set up starting group
	protected function setupStartGroup()
	{

		// Exit if no groups
		if ($this->DisplayGroups == 0)
			return;
		$startGrp = Param(Config("TABLE_START_GROUP"), "");
		$pageNo = Param("pageno", "");

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGroup = $startGrp;
			$this->setStartGroup($this->StartGroup);
		} elseif ($pageNo != "") {
			if (is_numeric($pageNo)) {
				$this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
				if ($this->StartGroup <= 0) {
					$this->StartGroup = 1;
				} elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
					$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
				}
				$this->setStartGroup($this->StartGroup);
			} else {
				$this->StartGroup = $this->getStartGroup();
			}
		} else {
			$this->StartGroup = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
			$this->StartGroup = 1; // Reset start group counter
			$this->setStartGroup($this->StartGroup);
		} elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
			$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
			$this->setStartGroup($this->StartGroup);
		} elseif (($this->StartGroup-1) % $this->DisplayGroups != 0) {
			$this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
			$this->setStartGroup($this->StartGroup);
		}
	}

	// Reset pager
	protected function resetPager()
	{

		// Reset start position (reset command)
		$this->StartGroup = 1;
		$this->setStartGroup($this->StartGroup);
	}

	// Set up number of groups displayed per page
	protected function setupDisplayGroups()
	{
		if (Param(Config("TABLE_GROUP_PER_PAGE")) !== NULL) {
			$wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
			if (is_numeric($wrk)) {
				$this->DisplayGroups = intval($wrk);
			} else {
				if (strtoupper($wrk) == "ALL") { // Display all groups
					$this->DisplayGroups = -1;
				} else {
					$this->DisplayGroups = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGroups); // Save to session

			// Reset start position (reset command)
			$this->StartGroup = 1;
			$this->setStartGroup($this->StartGroup);
		} else {
			if ($this->getGroupPerPage() != "") {
				$this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGroups = 3; // Load default
			}
		}
	}

	// Get sort parameters based on sort links clicked
	protected function getSort()
	{
		if ($this->DrillDown)
			return "`ngay_sua_chua` ASC";
		$resetSort = Param("cmd") === "resetsort";
		$orderBy = Param("order", "");
		$orderType = Param("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->nhan_vien_id->setSort("");
			$this->ngay_sua_chua->setSort("");
			$this->thoi_gian->setSort("");
			$this->noi_dung->setSort("");
			$this->so_don_hang_id->setSort("");
			$this->chuanloai_id->setSort("");
			$this->thiet_bi_id->setSort("");
			$this->ngay_hoan_thanh->setSort("");
			$this->baoduong_dinhky->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->nhan_vien_id); // nhan_vien_id
			$this->updateSort($this->ngay_sua_chua); // ngay_sua_chua
			$this->updateSort($this->thoi_gian); // thoi_gian
			$this->updateSort($this->noi_dung); // noi_dung
			$this->updateSort($this->so_don_hang_id); // so_don_hang_id
			$this->updateSort($this->chuanloai_id); // chuanloai_id
			$this->updateSort($this->thiet_bi_id); // thiet_bi_id
			$this->updateSort($this->ngay_hoan_thanh); // ngay_hoan_thanh
			$this->updateSort($this->baoduong_dinhky); // baoduong_dinhky
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}

		// Set up default sort
		if ($this->getOrderBy() == "") {
			$this->setOrderBy("`ngay_sua_chua` ASC");
			$this->ngay_sua_chua->setSort("ASC");
		}
		return $this->getOrderBy();
	}

	// Return extended filter
	protected function getExtendedFilter()
	{
		global $FormError;
		$filter = "";
		if ($this->DrillDown)
			return "";
		$restoreSession = FALSE;
		$restoreDefault = FALSE;

		// Reset search command
		if (Get("cmd", "") == "reset") {

			// Set default values
			$this->nhan_vien_id->AdvancedSearch->unsetSession();
			$this->ngay_sua_chua->AdvancedSearch->unsetSession();
			$this->so_don_hang_id->AdvancedSearch->unsetSession();
			$this->chuanloai_id->AdvancedSearch->unsetSession();
			$this->thiet_bi_id->AdvancedSearch->unsetSession();
			$this->baoduong_dinhky->AdvancedSearch->unsetSession();
			$restoreDefault = TRUE;
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field nhan_vien_id
			$this->getDropDownValue($this->nhan_vien_id);

			// Field ngay_sua_chua
			if ($this->ngay_sua_chua->AdvancedSearch->get()) {
			}

			// Field so_don_hang_id
			if ($this->so_don_hang_id->AdvancedSearch->get()) {
			}

			// Field chuanloai_id
			$this->getDropDownValue($this->chuanloai_id);

			// Field thiet_bi_id
			$this->getDropDownValue($this->thiet_bi_id);

			// Field baoduong_dinhky
			$this->getDropDownValue($this->baoduong_dinhky);
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$restoreDefault = TRUE;
			if ($this->nhan_vien_id->AdvancedSearch->issetSession()) { // Field nhan_vien_id
				$this->nhan_vien_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->ngay_sua_chua->AdvancedSearch->issetSession()) { // Field ngay_sua_chua
				$this->ngay_sua_chua->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->so_don_hang_id->AdvancedSearch->issetSession()) { // Field so_don_hang_id
				$this->so_don_hang_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->chuanloai_id->AdvancedSearch->issetSession()) { // Field chuanloai_id
				$this->chuanloai_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->thiet_bi_id->AdvancedSearch->issetSession()) { // Field thiet_bi_id
				$this->thiet_bi_id->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->baoduong_dinhky->AdvancedSearch->issetSession()) { // Field baoduong_dinhky
				$this->baoduong_dinhky->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
		}

		// Restore default
		if ($restoreDefault)
			$this->loadDefaultFilters();

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL and save to session
		$this->buildDropDownFilter($this->nhan_vien_id, $filter, $this->nhan_vien_id->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field nhan_vien_id
		$this->nhan_vien_id->AdvancedSearch->save();
		$this->buildExtendedFilter($this->ngay_sua_chua, $filter, FALSE, TRUE); // Field ngay_sua_chua
		$this->ngay_sua_chua->AdvancedSearch->save();
		$this->buildExtendedFilter($this->so_don_hang_id, $filter, FALSE, TRUE); // Field so_don_hang_id
		$this->so_don_hang_id->AdvancedSearch->save();
		$this->buildDropDownFilter($this->chuanloai_id, $filter, $this->chuanloai_id->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field chuanloai_id
		$this->chuanloai_id->AdvancedSearch->save();
		$this->buildDropDownFilter($this->thiet_bi_id, $filter, $this->thiet_bi_id->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field thiet_bi_id
		$this->thiet_bi_id->AdvancedSearch->save();
		$this->buildDropDownFilter($this->baoduong_dinhky, $filter, $this->baoduong_dinhky->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field baoduong_dinhky
		$this->baoduong_dinhky->AdvancedSearch->save();

		// Field nhan_vien_id
		LoadDropDownList($this->nhan_vien_id->EditValue, $this->nhan_vien_id->AdvancedSearch->SearchValue);

		// Field chuanloai_id
		LoadDropDownList($this->chuanloai_id->EditValue, $this->chuanloai_id->AdvancedSearch->SearchValue);

		// Field thiet_bi_id
		LoadDropDownList($this->thiet_bi_id->EditValue, $this->thiet_bi_id->AdvancedSearch->SearchValue);

		// Field baoduong_dinhky
		LoadDropDownList($this->baoduong_dinhky->EditValue, $this->baoduong_dinhky->AdvancedSearch->SearchValue);
		return $filter;
	}

	// Build dropdown filter
	protected function buildDropDownFilter(&$fld, &$filterClause, $fldOpr, $default = FALSE, $saveFilter = FALSE)
	{
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$sql = "";
		if (is_array($fldVal)) {
			foreach ($fldVal as $val) {
				$wrk = $this->getDropDownFilter($fld, $val, $fldOpr);

				// Call Page Filtering event
				if (!StartsString("@@", $val))
					$this->Page_Filtering($fld, $wrk, "dropdown", $fldOpr, $val);
				if ($wrk != "") {
					if ($sql != "")
						$sql .= " OR " . $wrk;
					else
						$sql = $wrk;
				}
			}
		} else {
			$sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr);

			// Call Page Filtering event
			if (!StartsString("@@", $fldVal))
				$this->Page_Filtering($fld, $sql, "dropdown", $fldOpr, $fldVal);
		}
		if ($sql != "") {
			AddFilter($filterClause, $sql);
			if ($saveFilter) $fld->CurrentFilter = $sql;
		}
	}

	// Get dropdown filter
	protected function getDropDownFilter(&$fld, $fldVal, $fldOpr)
	{
		$fldName = $fld->Name;
		$fldExpression = $fld->Expression;
		$fldDataType = $fld->DataType;
		$isMultiple = $fld->HtmlTag == "CHECKBOX" || $fld->HtmlTag == "SELECT" && $fld->SelectMultiple;
		$fldVal = strval($fldVal);
		if ($fldOpr == "") $fldOpr = "=";
		$wrk = "";
		if (SameString($fldVal, Config("NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NULL";
		} elseif (SameString($fldVal, Config("NOT_NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NOT NULL";
		} elseif (SameString($fldVal, EMPTY_VALUE)) {
			$wrk = $fldExpression . " = ''";
		} elseif (SameString($fldVal, ALL_VALUE)) {
			$wrk = "1 = 1";
		} else {
			if ($fld->GroupSql != "") // Use grouping SQL for search if exists
				$fldExpression = str_replace("%s", $fldExpression, $fld->GroupSql);
			if (StartsString("@@", $fldVal)) {
				$wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
			} elseif ($isMultiple && IsMultiSearchOperator($fldOpr) && trim($fldVal) != "" && $fldVal != INIT_VALUE && ($fldDataType == DATATYPE_STRING || $fldDataType == DATATYPE_MEMO)) {
				$wrk = GetMultiSearchSql($fld, $fldOpr, trim($fldVal), $this->Dbid);
			} else {
				if ($fldVal != "" && $fldVal != INIT_VALUE) {
					if ($fldDataType == DATATYPE_DATE && $fld->GroupSql == "" && $fldOpr != "") {
						$wrk = GetDateFilterSql($fldExpression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
					} else {
						$wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
						if ($wrk != "") $wrk = $fldExpression . $wrk;
					}
				}
			}
		}
		return $wrk;
	}

	// Get custom filter
	protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
	{
		$wrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $fldVal && $filter->Enabled) {
					$fldExpr = $fld->Expression;
					$fn = $filter->FunctionName;
					$wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
					if ($fn != "") {
						$fn = PROJECT_NAMESPACE . $fn;
						$wrk = $fn($fldExpr, $dbid);
					} else
						$wrk = "";
					$this->Page_Filtering($fld, $wrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $wrk;
	}

	// Build extended filter
	protected function buildExtendedFilter(&$fld, &$filterClause, $default = FALSE, $saveFilter = FALSE)
	{
		$wrk = GetExtendedFilter($fld, $default, $this->Dbid);
		if (!$default)
			$this->Page_Filtering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
		if ($wrk != "") {
			AddFilter($filterClause, $wrk);
			if ($saveFilter) $fld->CurrentFilter = $wrk;
		}
	}

	// Get drop down value from querystring
	protected function getDropDownValue(&$fld)
	{
		$parm = $fld->Param;
		if (IsPost())
			return FALSE; // Skip post back
		$opr = Get("z_$parm");
		if ($opr !== NULL)
			$fld->AdvancedSearch->SearchOperator = $opr;
		$val = Get("x_$parm");
		if ($val !== NULL) {
			if (is_array($val))
				$val = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val); 
			$fld->AdvancedSearch->setSearchValue($val);
			return TRUE;
		}
		return FALSE;
	}

	// Dropdown filter exist
	protected function dropDownFilterExist(&$fld, $fldOpr)
	{
		$wrk = "";
		$this->buildDropDownFilter($fld, $wrk, $fldOpr);
		return ($wrk != "");
	}

	// Extended filter exist
	protected function extendedFilterExist(&$fld)
	{
		$extWrk = "";
		$this->buildExtendedFilter($fld, $extWrk);
		return ($extWrk != "");
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if (!CheckByRegEx($this->baoduong_dinhky->FormValue, /^[10]+$/)) {
			AddMessage($FormError, $this->baoduong_dinhky->errorMessage());
		}
		if (!CheckByRegEx($this->baoduong_dinhky->FormValue, /^[10]+$/)) {
			AddMessage($FormError, $this->baoduong_dinhky->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			$FormError .= ($FormError != "") ? "<p>&nbsp;</p>" : "";
			$FormError .= $formCustomError;
		}
		return $validateForm;
	}

	// Load default value for filters
	protected function loadDefaultFilters()
	{

		/**
		* Set up default values for extended filters
		*/
		// Field nhan_vien_id

		$this->nhan_vien_id->AdvancedSearch->loadDefault();

		// Field ngay_sua_chua
		$this->ngay_sua_chua->AdvancedSearch->loadDefault();

		// Field so_don_hang_id
		$this->so_don_hang_id->AdvancedSearch->loadDefault();

		// Field chuanloai_id
		$this->chuanloai_id->AdvancedSearch->loadDefault();

		// Field thiet_bi_id
		$this->thiet_bi_id->AdvancedSearch->loadDefault();

		// Field baoduong_dinhky
		$this->baoduong_dinhky->AdvancedSearch->loadDefault();
	}

	// Show list of filters
	public function showFilterList()
	{
		global $Language;

		// Initialize
		$filterList = "";
		$captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
		$captionSuffix = $this->isExport("email") ? ": " : "";

		// Field nhan_vien_id
		$extWrk = "";
		$this->buildDropDownFilter($this->nhan_vien_id, $extWrk, $this->nhan_vien_id->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->nhan_vien_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field ngay_sua_chua
		$extWrk = "";
		$this->buildExtendedFilter($this->ngay_sua_chua, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->ngay_sua_chua->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field so_don_hang_id
		$extWrk = "";
		$this->buildExtendedFilter($this->so_don_hang_id, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->so_don_hang_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field chuanloai_id
		$extWrk = "";
		$this->buildDropDownFilter($this->chuanloai_id, $extWrk, $this->chuanloai_id->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->chuanloai_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field thiet_bi_id
		$extWrk = "";
		$this->buildDropDownFilter($this->thiet_bi_id, $extWrk, $this->thiet_bi_id->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->thiet_bi_id->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field baoduong_dinhky
		$extWrk = "";
		$this->buildDropDownFilter($this->baoduong_dinhky, $extWrk, $this->baoduong_dinhky->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->baoduong_dinhky->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Show Filters
		if ($filterList != "") {
			$message = "<div id=\"ew-filter-list\" class=\"alert alert-info d-table\"><div id=\"ew-current-filters\">" .
				$Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
			$this->Message_Showing($message, "");
			Write($message);
		}
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Field nhan_vien_id
		$wrk = "";
		$wrk = ($this->nhan_vien_id->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->nhan_vien_id->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_nhan_vien_id\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field ngay_sua_chua
		$wrk = "";
		if ($this->ngay_sua_chua->AdvancedSearch->SearchValue != "" || $this->ngay_sua_chua->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_ngay_sua_chua\":\"" . JsEncode($this->ngay_sua_chua->AdvancedSearch->SearchValue) . "\"," .
				"\"z_ngay_sua_chua\":\"" . JsEncode($this->ngay_sua_chua->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_ngay_sua_chua\":\"" . JsEncode($this->ngay_sua_chua->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_ngay_sua_chua\":\"" . JsEncode($this->ngay_sua_chua->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_ngay_sua_chua\":\"" . JsEncode($this->ngay_sua_chua->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field so_don_hang_id
		$wrk = "";
		if ($this->so_don_hang_id->AdvancedSearch->SearchValue != "" || $this->so_don_hang_id->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_so_don_hang_id\":\"" . JsEncode($this->so_don_hang_id->AdvancedSearch->SearchValue) . "\"," .
				"\"z_so_don_hang_id\":\"" . JsEncode($this->so_don_hang_id->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_so_don_hang_id\":\"" . JsEncode($this->so_don_hang_id->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_so_don_hang_id\":\"" . JsEncode($this->so_don_hang_id->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_so_don_hang_id\":\"" . JsEncode($this->so_don_hang_id->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field chuanloai_id
		$wrk = "";
		$wrk = ($this->chuanloai_id->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->chuanloai_id->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_chuanloai_id\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field thiet_bi_id
		$wrk = "";
		$wrk = ($this->thiet_bi_id->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->thiet_bi_id->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_thiet_bi_id\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field baoduong_dinhky
		$wrk = "";
		$wrk = ($this->baoduong_dinhky->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->baoduong_dinhky->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_baoduong_dinhky\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Return filter list in json
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd", "") != "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter", ""), TRUE);
		return $this->setupFilterList($filter);
	}

	// Setup list of filters
	protected function setupFilterList($filter)
	{
		if (!is_array($filter))
			return FALSE;

		// Field nhan_vien_id
		if (!$this->nhan_vien_id->AdvancedSearch->getFromArray($filter))
			$this->nhan_vien_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->nhan_vien_id->AdvancedSearch->save();

		// Field ngay_sua_chua
		if (!$this->ngay_sua_chua->AdvancedSearch->getFromArray($filter))
			$this->ngay_sua_chua->AdvancedSearch->loadDefault(); // Clear filter
		$this->ngay_sua_chua->AdvancedSearch->save();

		// Field so_don_hang_id
		if (!$this->so_don_hang_id->AdvancedSearch->getFromArray($filter))
			$this->so_don_hang_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->so_don_hang_id->AdvancedSearch->save();

		// Field chuanloai_id
		if (!$this->chuanloai_id->AdvancedSearch->getFromArray($filter))
			$this->chuanloai_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->chuanloai_id->AdvancedSearch->save();

		// Field thiet_bi_id
		if (!$this->thiet_bi_id->AdvancedSearch->getFromArray($filter))
			$this->thiet_bi_id->AdvancedSearch->loadDefault(); // Clear filter
		$this->thiet_bi_id->AdvancedSearch->save();

		// Field baoduong_dinhky
		if (!$this->baoduong_dinhky->AdvancedSearch->getFromArray($filter))
			$this->baoduong_dinhky->AdvancedSearch->loadDefault(); // Clear filter
		$this->baoduong_dinhky->AdvancedSearch->save();
		return TRUE;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>