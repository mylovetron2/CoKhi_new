<?php
namespace PHPMaker2020\projectCoKhi;

/**
 * Page class
 */
class nhan_vien_addopt extends nhan_vien
{

	// Page ID
	public $PageID = "addopt";

	// Project ID
	public $ProjectID = "{5DCEF576-624A-4686-A415-DE69CC04A397}";

	// Table name
	public $TableName = 'nhan_vien';

	// Page object name
	public $PageObjName = "nhan_vien_addopt";

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
		if ($this->TableName)
			return $Language->phrase($this->PageID);
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
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
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
		$hidden = FALSE;
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
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
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

		// Table object (nhan_vien)
		if (!isset($GLOBALS["nhan_vien"]) || get_class($GLOBALS["nhan_vien"]) == PROJECT_NAMESPACE . "nhan_vien") {
			$GLOBALS["nhan_vien"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["nhan_vien"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'addopt');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'nhan_vien');

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
		global $nhan_vien;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($nhan_vien);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
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
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['nhan_vien_id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
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

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("nhan_vienlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("nhan_vienlist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->nhan_vien_id->setVisibility();
		$this->danh_so->setVisibility();
		$this->ten_nhan_vien->setVisibility();
		$this->chuc_danh->setVisibility();
		$this->luong->setVisibility();
		$this->ngay_vao_dk->setVisibility();
		$this->ngay_vao_ld->setVisibility();
		$this->ngayll->setVisibility();
		$this->ngay_sinh->setVisibility();
		$this->ncl1->setVisibility();
		$this->ncl2->setVisibility();
		$this->ncl3->setVisibility();
		$this->DTCQ->setVisibility();
		$this->DTNR->setVisibility();
		$this->DTDD->setVisibility();
		$this->que_quan->setVisibility();
		$this->dia_chi_noi_o->setVisibility();
		$this->cmnd->setVisibility();
		$this->noi_cap->setVisibility();
		$this->ngay_cap->setVisibility();
		$this->bo_phan_id->setVisibility();
		$this->username->setVisibility();
		$this->password->setVisibility();
		$this->_userlevel->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->_userlevel);
		set_error_handler(PROJECT_NAMESPACE . "ErrorHandler");

		// Set up Breadcrumb
		//$this->setupBreadcrumb(); // Not used

		$this->loadRowValues(); // Load default values

		// Render row
		$this->RowType = ROWTYPE_ADD; // Render add type
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->nhan_vien_id->CurrentValue = NULL;
		$this->nhan_vien_id->OldValue = $this->nhan_vien_id->CurrentValue;
		$this->danh_so->CurrentValue = NULL;
		$this->danh_so->OldValue = $this->danh_so->CurrentValue;
		$this->ten_nhan_vien->CurrentValue = NULL;
		$this->ten_nhan_vien->OldValue = $this->ten_nhan_vien->CurrentValue;
		$this->chuc_danh->CurrentValue = NULL;
		$this->chuc_danh->OldValue = $this->chuc_danh->CurrentValue;
		$this->luong->CurrentValue = NULL;
		$this->luong->OldValue = $this->luong->CurrentValue;
		$this->ngay_vao_dk->CurrentValue = NULL;
		$this->ngay_vao_dk->OldValue = $this->ngay_vao_dk->CurrentValue;
		$this->ngay_vao_ld->CurrentValue = NULL;
		$this->ngay_vao_ld->OldValue = $this->ngay_vao_ld->CurrentValue;
		$this->ngayll->CurrentValue = NULL;
		$this->ngayll->OldValue = $this->ngayll->CurrentValue;
		$this->ngay_sinh->CurrentValue = NULL;
		$this->ngay_sinh->OldValue = $this->ngay_sinh->CurrentValue;
		$this->ncl1->CurrentValue = NULL;
		$this->ncl1->OldValue = $this->ncl1->CurrentValue;
		$this->ncl2->CurrentValue = NULL;
		$this->ncl2->OldValue = $this->ncl2->CurrentValue;
		$this->ncl3->CurrentValue = NULL;
		$this->ncl3->OldValue = $this->ncl3->CurrentValue;
		$this->DTCQ->CurrentValue = NULL;
		$this->DTCQ->OldValue = $this->DTCQ->CurrentValue;
		$this->DTNR->CurrentValue = NULL;
		$this->DTNR->OldValue = $this->DTNR->CurrentValue;
		$this->DTDD->CurrentValue = NULL;
		$this->DTDD->OldValue = $this->DTDD->CurrentValue;
		$this->que_quan->CurrentValue = NULL;
		$this->que_quan->OldValue = $this->que_quan->CurrentValue;
		$this->dia_chi_noi_o->CurrentValue = NULL;
		$this->dia_chi_noi_o->OldValue = $this->dia_chi_noi_o->CurrentValue;
		$this->cmnd->CurrentValue = NULL;
		$this->cmnd->OldValue = $this->cmnd->CurrentValue;
		$this->noi_cap->CurrentValue = NULL;
		$this->noi_cap->OldValue = $this->noi_cap->CurrentValue;
		$this->ngay_cap->CurrentValue = NULL;
		$this->ngay_cap->OldValue = $this->ngay_cap->CurrentValue;
		$this->bo_phan_id->CurrentValue = NULL;
		$this->bo_phan_id->OldValue = $this->bo_phan_id->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->password->CurrentValue = NULL;
		$this->password->OldValue = $this->password->CurrentValue;
		$this->_userlevel->CurrentValue = NULL;
		$this->_userlevel->OldValue = $this->_userlevel->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'nhan_vien_id' first before field var 'x_nhan_vien_id'
		$val = $CurrentForm->hasValue("nhan_vien_id") ? $CurrentForm->getValue("nhan_vien_id") : $CurrentForm->getValue("x_nhan_vien_id");
		if (!$this->nhan_vien_id->IsDetailKey) {
			$this->nhan_vien_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'danh_so' first before field var 'x_danh_so'
		$val = $CurrentForm->hasValue("danh_so") ? $CurrentForm->getValue("danh_so") : $CurrentForm->getValue("x_danh_so");
		if (!$this->danh_so->IsDetailKey) {
			$this->danh_so->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'ten_nhan_vien' first before field var 'x_ten_nhan_vien'
		$val = $CurrentForm->hasValue("ten_nhan_vien") ? $CurrentForm->getValue("ten_nhan_vien") : $CurrentForm->getValue("x_ten_nhan_vien");
		if (!$this->ten_nhan_vien->IsDetailKey) {
			$this->ten_nhan_vien->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'chuc_danh' first before field var 'x_chuc_danh'
		$val = $CurrentForm->hasValue("chuc_danh") ? $CurrentForm->getValue("chuc_danh") : $CurrentForm->getValue("x_chuc_danh");
		if (!$this->chuc_danh->IsDetailKey) {
			$this->chuc_danh->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'luong' first before field var 'x_luong'
		$val = $CurrentForm->hasValue("luong") ? $CurrentForm->getValue("luong") : $CurrentForm->getValue("x_luong");
		if (!$this->luong->IsDetailKey) {
			$this->luong->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'ngay_vao_dk' first before field var 'x_ngay_vao_dk'
		$val = $CurrentForm->hasValue("ngay_vao_dk") ? $CurrentForm->getValue("ngay_vao_dk") : $CurrentForm->getValue("x_ngay_vao_dk");
		if (!$this->ngay_vao_dk->IsDetailKey) {
			$this->ngay_vao_dk->setFormValue(ConvertFromUtf8($val));
			$this->ngay_vao_dk->CurrentValue = UnFormatDateTime($this->ngay_vao_dk->CurrentValue, 0);
		}

		// Check field name 'ngay_vao_ld' first before field var 'x_ngay_vao_ld'
		$val = $CurrentForm->hasValue("ngay_vao_ld") ? $CurrentForm->getValue("ngay_vao_ld") : $CurrentForm->getValue("x_ngay_vao_ld");
		if (!$this->ngay_vao_ld->IsDetailKey) {
			$this->ngay_vao_ld->setFormValue(ConvertFromUtf8($val));
			$this->ngay_vao_ld->CurrentValue = UnFormatDateTime($this->ngay_vao_ld->CurrentValue, 0);
		}

		// Check field name 'ngayll' first before field var 'x_ngayll'
		$val = $CurrentForm->hasValue("ngayll") ? $CurrentForm->getValue("ngayll") : $CurrentForm->getValue("x_ngayll");
		if (!$this->ngayll->IsDetailKey) {
			$this->ngayll->setFormValue(ConvertFromUtf8($val));
			$this->ngayll->CurrentValue = UnFormatDateTime($this->ngayll->CurrentValue, 0);
		}

		// Check field name 'ngay_sinh' first before field var 'x_ngay_sinh'
		$val = $CurrentForm->hasValue("ngay_sinh") ? $CurrentForm->getValue("ngay_sinh") : $CurrentForm->getValue("x_ngay_sinh");
		if (!$this->ngay_sinh->IsDetailKey) {
			$this->ngay_sinh->setFormValue(ConvertFromUtf8($val));
			$this->ngay_sinh->CurrentValue = UnFormatDateTime($this->ngay_sinh->CurrentValue, 0);
		}

		// Check field name 'ncl1' first before field var 'x_ncl1'
		$val = $CurrentForm->hasValue("ncl1") ? $CurrentForm->getValue("ncl1") : $CurrentForm->getValue("x_ncl1");
		if (!$this->ncl1->IsDetailKey) {
			$this->ncl1->setFormValue(ConvertFromUtf8($val));
			$this->ncl1->CurrentValue = UnFormatDateTime($this->ncl1->CurrentValue, 0);
		}

		// Check field name 'ncl2' first before field var 'x_ncl2'
		$val = $CurrentForm->hasValue("ncl2") ? $CurrentForm->getValue("ncl2") : $CurrentForm->getValue("x_ncl2");
		if (!$this->ncl2->IsDetailKey) {
			$this->ncl2->setFormValue(ConvertFromUtf8($val));
			$this->ncl2->CurrentValue = UnFormatDateTime($this->ncl2->CurrentValue, 0);
		}

		// Check field name 'ncl3' first before field var 'x_ncl3'
		$val = $CurrentForm->hasValue("ncl3") ? $CurrentForm->getValue("ncl3") : $CurrentForm->getValue("x_ncl3");
		if (!$this->ncl3->IsDetailKey) {
			$this->ncl3->setFormValue(ConvertFromUtf8($val));
			$this->ncl3->CurrentValue = UnFormatDateTime($this->ncl3->CurrentValue, 0);
		}

		// Check field name 'DTCQ' first before field var 'x_DTCQ'
		$val = $CurrentForm->hasValue("DTCQ") ? $CurrentForm->getValue("DTCQ") : $CurrentForm->getValue("x_DTCQ");
		if (!$this->DTCQ->IsDetailKey) {
			$this->DTCQ->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'DTNR' first before field var 'x_DTNR'
		$val = $CurrentForm->hasValue("DTNR") ? $CurrentForm->getValue("DTNR") : $CurrentForm->getValue("x_DTNR");
		if (!$this->DTNR->IsDetailKey) {
			$this->DTNR->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'DTDD' first before field var 'x_DTDD'
		$val = $CurrentForm->hasValue("DTDD") ? $CurrentForm->getValue("DTDD") : $CurrentForm->getValue("x_DTDD");
		if (!$this->DTDD->IsDetailKey) {
			$this->DTDD->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'que_quan' first before field var 'x_que_quan'
		$val = $CurrentForm->hasValue("que_quan") ? $CurrentForm->getValue("que_quan") : $CurrentForm->getValue("x_que_quan");
		if (!$this->que_quan->IsDetailKey) {
			$this->que_quan->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'dia_chi_noi_o' first before field var 'x_dia_chi_noi_o'
		$val = $CurrentForm->hasValue("dia_chi_noi_o") ? $CurrentForm->getValue("dia_chi_noi_o") : $CurrentForm->getValue("x_dia_chi_noi_o");
		if (!$this->dia_chi_noi_o->IsDetailKey) {
			$this->dia_chi_noi_o->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'cmnd' first before field var 'x_cmnd'
		$val = $CurrentForm->hasValue("cmnd") ? $CurrentForm->getValue("cmnd") : $CurrentForm->getValue("x_cmnd");
		if (!$this->cmnd->IsDetailKey) {
			$this->cmnd->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'noi_cap' first before field var 'x_noi_cap'
		$val = $CurrentForm->hasValue("noi_cap") ? $CurrentForm->getValue("noi_cap") : $CurrentForm->getValue("x_noi_cap");
		if (!$this->noi_cap->IsDetailKey) {
			$this->noi_cap->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'ngay_cap' first before field var 'x_ngay_cap'
		$val = $CurrentForm->hasValue("ngay_cap") ? $CurrentForm->getValue("ngay_cap") : $CurrentForm->getValue("x_ngay_cap");
		if (!$this->ngay_cap->IsDetailKey) {
			$this->ngay_cap->setFormValue(ConvertFromUtf8($val));
			$this->ngay_cap->CurrentValue = UnFormatDateTime($this->ngay_cap->CurrentValue, 0);
		}

		// Check field name 'bo_phan_id' first before field var 'x_bo_phan_id'
		$val = $CurrentForm->hasValue("bo_phan_id") ? $CurrentForm->getValue("bo_phan_id") : $CurrentForm->getValue("x_bo_phan_id");
		if (!$this->bo_phan_id->IsDetailKey) {
			$this->bo_phan_id->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'username' first before field var 'x_username'
		$val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x_username");
		if (!$this->username->IsDetailKey) {
			$this->username->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'password' first before field var 'x_password'
		$val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x_password");
		if (!$this->password->IsDetailKey) {
			$this->password->setFormValue(ConvertFromUtf8($val));
		}

		// Check field name 'userlevel' first before field var 'x__userlevel'
		$val = $CurrentForm->hasValue("userlevel") ? $CurrentForm->getValue("userlevel") : $CurrentForm->getValue("x__userlevel");
		if (!$this->_userlevel->IsDetailKey) {
			$this->_userlevel->setFormValue(ConvertFromUtf8($val));
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nhan_vien_id->CurrentValue = ConvertToUtf8($this->nhan_vien_id->FormValue);
		$this->danh_so->CurrentValue = ConvertToUtf8($this->danh_so->FormValue);
		$this->ten_nhan_vien->CurrentValue = ConvertToUtf8($this->ten_nhan_vien->FormValue);
		$this->chuc_danh->CurrentValue = ConvertToUtf8($this->chuc_danh->FormValue);
		$this->luong->CurrentValue = ConvertToUtf8($this->luong->FormValue);
		$this->ngay_vao_dk->CurrentValue = ConvertToUtf8($this->ngay_vao_dk->FormValue);
		$this->ngay_vao_dk->CurrentValue = UnFormatDateTime($this->ngay_vao_dk->CurrentValue, 0);
		$this->ngay_vao_ld->CurrentValue = ConvertToUtf8($this->ngay_vao_ld->FormValue);
		$this->ngay_vao_ld->CurrentValue = UnFormatDateTime($this->ngay_vao_ld->CurrentValue, 0);
		$this->ngayll->CurrentValue = ConvertToUtf8($this->ngayll->FormValue);
		$this->ngayll->CurrentValue = UnFormatDateTime($this->ngayll->CurrentValue, 0);
		$this->ngay_sinh->CurrentValue = ConvertToUtf8($this->ngay_sinh->FormValue);
		$this->ngay_sinh->CurrentValue = UnFormatDateTime($this->ngay_sinh->CurrentValue, 0);
		$this->ncl1->CurrentValue = ConvertToUtf8($this->ncl1->FormValue);
		$this->ncl1->CurrentValue = UnFormatDateTime($this->ncl1->CurrentValue, 0);
		$this->ncl2->CurrentValue = ConvertToUtf8($this->ncl2->FormValue);
		$this->ncl2->CurrentValue = UnFormatDateTime($this->ncl2->CurrentValue, 0);
		$this->ncl3->CurrentValue = ConvertToUtf8($this->ncl3->FormValue);
		$this->ncl3->CurrentValue = UnFormatDateTime($this->ncl3->CurrentValue, 0);
		$this->DTCQ->CurrentValue = ConvertToUtf8($this->DTCQ->FormValue);
		$this->DTNR->CurrentValue = ConvertToUtf8($this->DTNR->FormValue);
		$this->DTDD->CurrentValue = ConvertToUtf8($this->DTDD->FormValue);
		$this->que_quan->CurrentValue = ConvertToUtf8($this->que_quan->FormValue);
		$this->dia_chi_noi_o->CurrentValue = ConvertToUtf8($this->dia_chi_noi_o->FormValue);
		$this->cmnd->CurrentValue = ConvertToUtf8($this->cmnd->FormValue);
		$this->noi_cap->CurrentValue = ConvertToUtf8($this->noi_cap->FormValue);
		$this->ngay_cap->CurrentValue = ConvertToUtf8($this->ngay_cap->FormValue);
		$this->ngay_cap->CurrentValue = UnFormatDateTime($this->ngay_cap->CurrentValue, 0);
		$this->bo_phan_id->CurrentValue = ConvertToUtf8($this->bo_phan_id->FormValue);
		$this->username->CurrentValue = ConvertToUtf8($this->username->FormValue);
		$this->password->CurrentValue = ConvertToUtf8($this->password->FormValue);
		$this->_userlevel->CurrentValue = ConvertToUtf8($this->_userlevel->FormValue);
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->nhan_vien_id->setDbValue($row['nhan_vien_id']);
		$this->danh_so->setDbValue($row['danh_so']);
		$this->ten_nhan_vien->setDbValue($row['ten_nhan_vien']);
		$this->chuc_danh->setDbValue($row['chuc_danh']);
		$this->luong->setDbValue($row['luong']);
		$this->ngay_vao_dk->setDbValue($row['ngay_vao_dk']);
		$this->ngay_vao_ld->setDbValue($row['ngay_vao_ld']);
		$this->ngayll->setDbValue($row['ngayll']);
		$this->ngay_sinh->setDbValue($row['ngay_sinh']);
		$this->ncl1->setDbValue($row['ncl1']);
		$this->ncl2->setDbValue($row['ncl2']);
		$this->ncl3->setDbValue($row['ncl3']);
		$this->DTCQ->setDbValue($row['DTCQ']);
		$this->DTNR->setDbValue($row['DTNR']);
		$this->DTDD->setDbValue($row['DTDD']);
		$this->que_quan->setDbValue($row['que_quan']);
		$this->dia_chi_noi_o->setDbValue($row['dia_chi_noi_o']);
		$this->cmnd->setDbValue($row['cmnd']);
		$this->noi_cap->setDbValue($row['noi_cap']);
		$this->ngay_cap->setDbValue($row['ngay_cap']);
		$this->bo_phan_id->setDbValue($row['bo_phan_id']);
		$this->username->setDbValue($row['username']);
		$this->password->setDbValue($row['password']);
		$this->_userlevel->setDbValue($row['userlevel']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['nhan_vien_id'] = $this->nhan_vien_id->CurrentValue;
		$row['danh_so'] = $this->danh_so->CurrentValue;
		$row['ten_nhan_vien'] = $this->ten_nhan_vien->CurrentValue;
		$row['chuc_danh'] = $this->chuc_danh->CurrentValue;
		$row['luong'] = $this->luong->CurrentValue;
		$row['ngay_vao_dk'] = $this->ngay_vao_dk->CurrentValue;
		$row['ngay_vao_ld'] = $this->ngay_vao_ld->CurrentValue;
		$row['ngayll'] = $this->ngayll->CurrentValue;
		$row['ngay_sinh'] = $this->ngay_sinh->CurrentValue;
		$row['ncl1'] = $this->ncl1->CurrentValue;
		$row['ncl2'] = $this->ncl2->CurrentValue;
		$row['ncl3'] = $this->ncl3->CurrentValue;
		$row['DTCQ'] = $this->DTCQ->CurrentValue;
		$row['DTNR'] = $this->DTNR->CurrentValue;
		$row['DTDD'] = $this->DTDD->CurrentValue;
		$row['que_quan'] = $this->que_quan->CurrentValue;
		$row['dia_chi_noi_o'] = $this->dia_chi_noi_o->CurrentValue;
		$row['cmnd'] = $this->cmnd->CurrentValue;
		$row['noi_cap'] = $this->noi_cap->CurrentValue;
		$row['ngay_cap'] = $this->ngay_cap->CurrentValue;
		$row['bo_phan_id'] = $this->bo_phan_id->CurrentValue;
		$row['username'] = $this->username->CurrentValue;
		$row['password'] = $this->password->CurrentValue;
		$row['userlevel'] = $this->_userlevel->CurrentValue;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nhan_vien_id
			$this->nhan_vien_id->EditAttrs["class"] = "form-control";
			$this->nhan_vien_id->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("addopt")) { // Non system admin
				$this->nhan_vien_id->CurrentValue = CurrentUserID();
				$this->nhan_vien_id->EditValue = FormatNumber($this->nhan_vien_id->EditValue, 0, -2, -2, -2);
				$this->nhan_vien_id->ViewCustomAttributes = "";
			} else {
			}

			// danh_so
			$this->danh_so->EditAttrs["class"] = "form-control";
			$this->danh_so->EditCustomAttributes = "";
			$this->danh_so->EditValue = HtmlEncode($this->danh_so->CurrentValue);
			$this->danh_so->PlaceHolder = RemoveHtml($this->danh_so->caption());

			// ten_nhan_vien
			$this->ten_nhan_vien->EditAttrs["class"] = "form-control";
			$this->ten_nhan_vien->EditCustomAttributes = "";
			if (!$this->ten_nhan_vien->Raw)
				$this->ten_nhan_vien->CurrentValue = HtmlDecode($this->ten_nhan_vien->CurrentValue);
			$this->ten_nhan_vien->EditValue = HtmlEncode($this->ten_nhan_vien->CurrentValue);
			$this->ten_nhan_vien->PlaceHolder = RemoveHtml($this->ten_nhan_vien->caption());

			// chuc_danh
			$this->chuc_danh->EditAttrs["class"] = "form-control";
			$this->chuc_danh->EditCustomAttributes = "";
			if (!$this->chuc_danh->Raw)
				$this->chuc_danh->CurrentValue = HtmlDecode($this->chuc_danh->CurrentValue);
			$this->chuc_danh->EditValue = HtmlEncode($this->chuc_danh->CurrentValue);
			$this->chuc_danh->PlaceHolder = RemoveHtml($this->chuc_danh->caption());

			// luong
			$this->luong->EditAttrs["class"] = "form-control";
			$this->luong->EditCustomAttributes = "";
			$this->luong->EditValue = HtmlEncode($this->luong->CurrentValue);
			$this->luong->PlaceHolder = RemoveHtml($this->luong->caption());

			// ngay_vao_dk
			$this->ngay_vao_dk->EditAttrs["class"] = "form-control";
			$this->ngay_vao_dk->EditCustomAttributes = "";
			$this->ngay_vao_dk->EditValue = HtmlEncode(FormatDateTime($this->ngay_vao_dk->CurrentValue, 8));
			$this->ngay_vao_dk->PlaceHolder = RemoveHtml($this->ngay_vao_dk->caption());

			// ngay_vao_ld
			$this->ngay_vao_ld->EditAttrs["class"] = "form-control";
			$this->ngay_vao_ld->EditCustomAttributes = "";
			$this->ngay_vao_ld->EditValue = HtmlEncode(FormatDateTime($this->ngay_vao_ld->CurrentValue, 8));
			$this->ngay_vao_ld->PlaceHolder = RemoveHtml($this->ngay_vao_ld->caption());

			// ngayll
			$this->ngayll->EditAttrs["class"] = "form-control";
			$this->ngayll->EditCustomAttributes = "";
			$this->ngayll->EditValue = HtmlEncode(FormatDateTime($this->ngayll->CurrentValue, 8));
			$this->ngayll->PlaceHolder = RemoveHtml($this->ngayll->caption());

			// ngay_sinh
			$this->ngay_sinh->EditAttrs["class"] = "form-control";
			$this->ngay_sinh->EditCustomAttributes = "";
			$this->ngay_sinh->EditValue = HtmlEncode(FormatDateTime($this->ngay_sinh->CurrentValue, 8));
			$this->ngay_sinh->PlaceHolder = RemoveHtml($this->ngay_sinh->caption());

			// ncl1
			$this->ncl1->EditAttrs["class"] = "form-control";
			$this->ncl1->EditCustomAttributes = "";
			$this->ncl1->EditValue = HtmlEncode(FormatDateTime($this->ncl1->CurrentValue, 8));
			$this->ncl1->PlaceHolder = RemoveHtml($this->ncl1->caption());

			// ncl2
			$this->ncl2->EditAttrs["class"] = "form-control";
			$this->ncl2->EditCustomAttributes = "";
			$this->ncl2->EditValue = HtmlEncode(FormatDateTime($this->ncl2->CurrentValue, 8));
			$this->ncl2->PlaceHolder = RemoveHtml($this->ncl2->caption());

			// ncl3
			$this->ncl3->EditAttrs["class"] = "form-control";
			$this->ncl3->EditCustomAttributes = "";
			$this->ncl3->EditValue = HtmlEncode(FormatDateTime($this->ncl3->CurrentValue, 8));
			$this->ncl3->PlaceHolder = RemoveHtml($this->ncl3->caption());

			// DTCQ
			$this->DTCQ->EditAttrs["class"] = "form-control";
			$this->DTCQ->EditCustomAttributes = "";
			if (!$this->DTCQ->Raw)
				$this->DTCQ->CurrentValue = HtmlDecode($this->DTCQ->CurrentValue);
			$this->DTCQ->EditValue = HtmlEncode($this->DTCQ->CurrentValue);
			$this->DTCQ->PlaceHolder = RemoveHtml($this->DTCQ->caption());

			// DTNR
			$this->DTNR->EditAttrs["class"] = "form-control";
			$this->DTNR->EditCustomAttributes = "";
			if (!$this->DTNR->Raw)
				$this->DTNR->CurrentValue = HtmlDecode($this->DTNR->CurrentValue);
			$this->DTNR->EditValue = HtmlEncode($this->DTNR->CurrentValue);
			$this->DTNR->PlaceHolder = RemoveHtml($this->DTNR->caption());

			// DTDD
			$this->DTDD->EditAttrs["class"] = "form-control";
			$this->DTDD->EditCustomAttributes = "";
			if (!$this->DTDD->Raw)
				$this->DTDD->CurrentValue = HtmlDecode($this->DTDD->CurrentValue);
			$this->DTDD->EditValue = HtmlEncode($this->DTDD->CurrentValue);
			$this->DTDD->PlaceHolder = RemoveHtml($this->DTDD->caption());

			// que_quan
			$this->que_quan->EditAttrs["class"] = "form-control";
			$this->que_quan->EditCustomAttributes = "";
			if (!$this->que_quan->Raw)
				$this->que_quan->CurrentValue = HtmlDecode($this->que_quan->CurrentValue);
			$this->que_quan->EditValue = HtmlEncode($this->que_quan->CurrentValue);
			$this->que_quan->PlaceHolder = RemoveHtml($this->que_quan->caption());

			// dia_chi_noi_o
			$this->dia_chi_noi_o->EditAttrs["class"] = "form-control";
			$this->dia_chi_noi_o->EditCustomAttributes = "";
			if (!$this->dia_chi_noi_o->Raw)
				$this->dia_chi_noi_o->CurrentValue = HtmlDecode($this->dia_chi_noi_o->CurrentValue);
			$this->dia_chi_noi_o->EditValue = HtmlEncode($this->dia_chi_noi_o->CurrentValue);
			$this->dia_chi_noi_o->PlaceHolder = RemoveHtml($this->dia_chi_noi_o->caption());

			// cmnd
			$this->cmnd->EditAttrs["class"] = "form-control";
			$this->cmnd->EditCustomAttributes = "";
			if (!$this->cmnd->Raw)
				$this->cmnd->CurrentValue = HtmlDecode($this->cmnd->CurrentValue);
			$this->cmnd->EditValue = HtmlEncode($this->cmnd->CurrentValue);
			$this->cmnd->PlaceHolder = RemoveHtml($this->cmnd->caption());

			// noi_cap
			$this->noi_cap->EditAttrs["class"] = "form-control";
			$this->noi_cap->EditCustomAttributes = "";
			if (!$this->noi_cap->Raw)
				$this->noi_cap->CurrentValue = HtmlDecode($this->noi_cap->CurrentValue);
			$this->noi_cap->EditValue = HtmlEncode($this->noi_cap->CurrentValue);
			$this->noi_cap->PlaceHolder = RemoveHtml($this->noi_cap->caption());

			// ngay_cap
			$this->ngay_cap->EditAttrs["class"] = "form-control";
			$this->ngay_cap->EditCustomAttributes = "";
			$this->ngay_cap->EditValue = HtmlEncode(FormatDateTime($this->ngay_cap->CurrentValue, 8));
			$this->ngay_cap->PlaceHolder = RemoveHtml($this->ngay_cap->caption());

			// bo_phan_id
			$this->bo_phan_id->EditAttrs["class"] = "form-control";
			$this->bo_phan_id->EditCustomAttributes = "";
			$this->bo_phan_id->EditValue = HtmlEncode($this->bo_phan_id->CurrentValue);
			$this->bo_phan_id->PlaceHolder = RemoveHtml($this->bo_phan_id->caption());

			// username
			$this->username->EditAttrs["class"] = "form-control";
			$this->username->EditCustomAttributes = "";
			if (!$this->username->Raw)
				$this->username->CurrentValue = HtmlDecode($this->username->CurrentValue);
			$this->username->EditValue = HtmlEncode($this->username->CurrentValue);
			$this->username->PlaceHolder = RemoveHtml($this->username->caption());

			// password
			$this->password->EditAttrs["class"] = "form-control";
			$this->password->EditCustomAttributes = "";
			if (!$this->password->Raw)
				$this->password->CurrentValue = HtmlDecode($this->password->CurrentValue);
			$this->password->EditValue = HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = RemoveHtml($this->password->caption());

			// userlevel
			$this->_userlevel->EditAttrs["class"] = "form-control";
			$this->_userlevel->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->_userlevel->EditValue = $Language->phrase("PasswordMask");
			} else {
				$curVal = trim(strval($this->_userlevel->CurrentValue));
				if ($curVal != "")
					$this->_userlevel->ViewValue = $this->_userlevel->lookupCacheOption($curVal);
				else
					$this->_userlevel->ViewValue = $this->_userlevel->Lookup !== NULL && is_array($this->_userlevel->Lookup->Options) ? $curVal : NULL;
				if ($this->_userlevel->ViewValue !== NULL) { // Load from cache
					$this->_userlevel->EditValue = array_values($this->_userlevel->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`userlevelid`" . SearchString("=", $this->_userlevel->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->_userlevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->_userlevel->EditValue = $arwrk;
				}
			}

			// Add refer script
			// nhan_vien_id

			$this->nhan_vien_id->LinkCustomAttributes = "";
			$this->nhan_vien_id->HrefValue = "";

			// danh_so
			$this->danh_so->LinkCustomAttributes = "";
			$this->danh_so->HrefValue = "";

			// ten_nhan_vien
			$this->ten_nhan_vien->LinkCustomAttributes = "";
			$this->ten_nhan_vien->HrefValue = "";

			// chuc_danh
			$this->chuc_danh->LinkCustomAttributes = "";
			$this->chuc_danh->HrefValue = "";

			// luong
			$this->luong->LinkCustomAttributes = "";
			$this->luong->HrefValue = "";

			// ngay_vao_dk
			$this->ngay_vao_dk->LinkCustomAttributes = "";
			$this->ngay_vao_dk->HrefValue = "";

			// ngay_vao_ld
			$this->ngay_vao_ld->LinkCustomAttributes = "";
			$this->ngay_vao_ld->HrefValue = "";

			// ngayll
			$this->ngayll->LinkCustomAttributes = "";
			$this->ngayll->HrefValue = "";

			// ngay_sinh
			$this->ngay_sinh->LinkCustomAttributes = "";
			$this->ngay_sinh->HrefValue = "";

			// ncl1
			$this->ncl1->LinkCustomAttributes = "";
			$this->ncl1->HrefValue = "";

			// ncl2
			$this->ncl2->LinkCustomAttributes = "";
			$this->ncl2->HrefValue = "";

			// ncl3
			$this->ncl3->LinkCustomAttributes = "";
			$this->ncl3->HrefValue = "";

			// DTCQ
			$this->DTCQ->LinkCustomAttributes = "";
			$this->DTCQ->HrefValue = "";

			// DTNR
			$this->DTNR->LinkCustomAttributes = "";
			$this->DTNR->HrefValue = "";

			// DTDD
			$this->DTDD->LinkCustomAttributes = "";
			$this->DTDD->HrefValue = "";

			// que_quan
			$this->que_quan->LinkCustomAttributes = "";
			$this->que_quan->HrefValue = "";

			// dia_chi_noi_o
			$this->dia_chi_noi_o->LinkCustomAttributes = "";
			$this->dia_chi_noi_o->HrefValue = "";

			// cmnd
			$this->cmnd->LinkCustomAttributes = "";
			$this->cmnd->HrefValue = "";

			// noi_cap
			$this->noi_cap->LinkCustomAttributes = "";
			$this->noi_cap->HrefValue = "";

			// ngay_cap
			$this->ngay_cap->LinkCustomAttributes = "";
			$this->ngay_cap->HrefValue = "";

			// bo_phan_id
			$this->bo_phan_id->LinkCustomAttributes = "";
			$this->bo_phan_id->HrefValue = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";

			// userlevel
			$this->_userlevel->LinkCustomAttributes = "";
			$this->_userlevel->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		if ($this->nhan_vien_id->Required) {
			if (!$this->nhan_vien_id->IsDetailKey && $this->nhan_vien_id->FormValue != NULL && $this->nhan_vien_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nhan_vien_id->caption(), $this->nhan_vien_id->RequiredErrorMessage));
			}
		}
		if ($this->danh_so->Required) {
			if (!$this->danh_so->IsDetailKey && $this->danh_so->FormValue != NULL && $this->danh_so->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->danh_so->caption(), $this->danh_so->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->danh_so->FormValue)) {
			AddMessage($FormError, $this->danh_so->errorMessage());
		}
		if ($this->ten_nhan_vien->Required) {
			if (!$this->ten_nhan_vien->IsDetailKey && $this->ten_nhan_vien->FormValue != NULL && $this->ten_nhan_vien->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ten_nhan_vien->caption(), $this->ten_nhan_vien->RequiredErrorMessage));
			}
		}
		if ($this->chuc_danh->Required) {
			if (!$this->chuc_danh->IsDetailKey && $this->chuc_danh->FormValue != NULL && $this->chuc_danh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->chuc_danh->caption(), $this->chuc_danh->RequiredErrorMessage));
			}
		}
		if ($this->luong->Required) {
			if (!$this->luong->IsDetailKey && $this->luong->FormValue != NULL && $this->luong->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->luong->caption(), $this->luong->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->luong->FormValue)) {
			AddMessage($FormError, $this->luong->errorMessage());
		}
		if ($this->ngay_vao_dk->Required) {
			if (!$this->ngay_vao_dk->IsDetailKey && $this->ngay_vao_dk->FormValue != NULL && $this->ngay_vao_dk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_vao_dk->caption(), $this->ngay_vao_dk->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ngay_vao_dk->FormValue)) {
			AddMessage($FormError, $this->ngay_vao_dk->errorMessage());
		}
		if ($this->ngay_vao_ld->Required) {
			if (!$this->ngay_vao_ld->IsDetailKey && $this->ngay_vao_ld->FormValue != NULL && $this->ngay_vao_ld->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_vao_ld->caption(), $this->ngay_vao_ld->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ngay_vao_ld->FormValue)) {
			AddMessage($FormError, $this->ngay_vao_ld->errorMessage());
		}
		if ($this->ngayll->Required) {
			if (!$this->ngayll->IsDetailKey && $this->ngayll->FormValue != NULL && $this->ngayll->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngayll->caption(), $this->ngayll->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ngayll->FormValue)) {
			AddMessage($FormError, $this->ngayll->errorMessage());
		}
		if ($this->ngay_sinh->Required) {
			if (!$this->ngay_sinh->IsDetailKey && $this->ngay_sinh->FormValue != NULL && $this->ngay_sinh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_sinh->caption(), $this->ngay_sinh->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ngay_sinh->FormValue)) {
			AddMessage($FormError, $this->ngay_sinh->errorMessage());
		}
		if ($this->ncl1->Required) {
			if (!$this->ncl1->IsDetailKey && $this->ncl1->FormValue != NULL && $this->ncl1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ncl1->caption(), $this->ncl1->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ncl1->FormValue)) {
			AddMessage($FormError, $this->ncl1->errorMessage());
		}
		if ($this->ncl2->Required) {
			if (!$this->ncl2->IsDetailKey && $this->ncl2->FormValue != NULL && $this->ncl2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ncl2->caption(), $this->ncl2->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ncl2->FormValue)) {
			AddMessage($FormError, $this->ncl2->errorMessage());
		}
		if ($this->ncl3->Required) {
			if (!$this->ncl3->IsDetailKey && $this->ncl3->FormValue != NULL && $this->ncl3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ncl3->caption(), $this->ncl3->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ncl3->FormValue)) {
			AddMessage($FormError, $this->ncl3->errorMessage());
		}
		if ($this->DTCQ->Required) {
			if (!$this->DTCQ->IsDetailKey && $this->DTCQ->FormValue != NULL && $this->DTCQ->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DTCQ->caption(), $this->DTCQ->RequiredErrorMessage));
			}
		}
		if ($this->DTNR->Required) {
			if (!$this->DTNR->IsDetailKey && $this->DTNR->FormValue != NULL && $this->DTNR->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DTNR->caption(), $this->DTNR->RequiredErrorMessage));
			}
		}
		if ($this->DTDD->Required) {
			if (!$this->DTDD->IsDetailKey && $this->DTDD->FormValue != NULL && $this->DTDD->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DTDD->caption(), $this->DTDD->RequiredErrorMessage));
			}
		}
		if ($this->que_quan->Required) {
			if (!$this->que_quan->IsDetailKey && $this->que_quan->FormValue != NULL && $this->que_quan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->que_quan->caption(), $this->que_quan->RequiredErrorMessage));
			}
		}
		if ($this->dia_chi_noi_o->Required) {
			if (!$this->dia_chi_noi_o->IsDetailKey && $this->dia_chi_noi_o->FormValue != NULL && $this->dia_chi_noi_o->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->dia_chi_noi_o->caption(), $this->dia_chi_noi_o->RequiredErrorMessage));
			}
		}
		if ($this->cmnd->Required) {
			if (!$this->cmnd->IsDetailKey && $this->cmnd->FormValue != NULL && $this->cmnd->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cmnd->caption(), $this->cmnd->RequiredErrorMessage));
			}
		}
		if ($this->noi_cap->Required) {
			if (!$this->noi_cap->IsDetailKey && $this->noi_cap->FormValue != NULL && $this->noi_cap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->noi_cap->caption(), $this->noi_cap->RequiredErrorMessage));
			}
		}
		if ($this->ngay_cap->Required) {
			if (!$this->ngay_cap->IsDetailKey && $this->ngay_cap->FormValue != NULL && $this->ngay_cap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_cap->caption(), $this->ngay_cap->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ngay_cap->FormValue)) {
			AddMessage($FormError, $this->ngay_cap->errorMessage());
		}
		if ($this->bo_phan_id->Required) {
			if (!$this->bo_phan_id->IsDetailKey && $this->bo_phan_id->FormValue != NULL && $this->bo_phan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bo_phan_id->caption(), $this->bo_phan_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->bo_phan_id->FormValue)) {
			AddMessage($FormError, $this->bo_phan_id->errorMessage());
		}
		if ($this->username->Required) {
			if (!$this->username->IsDetailKey && $this->username->FormValue != NULL && $this->username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->username->caption(), $this->username->RequiredErrorMessage));
			}
		}
		if ($this->password->Required) {
			if (!$this->password->IsDetailKey && $this->password->FormValue != NULL && $this->password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->password->caption(), $this->password->RequiredErrorMessage));
			}
		}
		if ($this->_userlevel->Required) {
			if (!$this->_userlevel->IsDetailKey && $this->_userlevel->FormValue != NULL && $this->_userlevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_userlevel->caption(), $this->_userlevel->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() != "" && !EmptyValue($this->nhan_vien_id->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->nhan_vien_id->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->nhan_vien_id->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// nhan_vien_id
		$this->nhan_vien_id->setDbValueDef($rsnew, $this->nhan_vien_id->CurrentValue, 0, FALSE);

		// danh_so
		$this->danh_so->setDbValueDef($rsnew, $this->danh_so->CurrentValue, 0, FALSE);

		// ten_nhan_vien
		$this->ten_nhan_vien->setDbValueDef($rsnew, $this->ten_nhan_vien->CurrentValue, "", FALSE);

		// chuc_danh
		$this->chuc_danh->setDbValueDef($rsnew, $this->chuc_danh->CurrentValue, NULL, FALSE);

		// luong
		$this->luong->setDbValueDef($rsnew, $this->luong->CurrentValue, NULL, FALSE);

		// ngay_vao_dk
		$this->ngay_vao_dk->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_vao_dk->CurrentValue, 0), NULL, FALSE);

		// ngay_vao_ld
		$this->ngay_vao_ld->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_vao_ld->CurrentValue, 0), NULL, FALSE);

		// ngayll
		$this->ngayll->setDbValueDef($rsnew, UnFormatDateTime($this->ngayll->CurrentValue, 0), NULL, FALSE);

		// ngay_sinh
		$this->ngay_sinh->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_sinh->CurrentValue, 0), NULL, FALSE);

		// ncl1
		$this->ncl1->setDbValueDef($rsnew, UnFormatDateTime($this->ncl1->CurrentValue, 0), NULL, FALSE);

		// ncl2
		$this->ncl2->setDbValueDef($rsnew, UnFormatDateTime($this->ncl2->CurrentValue, 0), NULL, FALSE);

		// ncl3
		$this->ncl3->setDbValueDef($rsnew, UnFormatDateTime($this->ncl3->CurrentValue, 0), NULL, FALSE);

		// DTCQ
		$this->DTCQ->setDbValueDef($rsnew, $this->DTCQ->CurrentValue, NULL, FALSE);

		// DTNR
		$this->DTNR->setDbValueDef($rsnew, $this->DTNR->CurrentValue, NULL, FALSE);

		// DTDD
		$this->DTDD->setDbValueDef($rsnew, $this->DTDD->CurrentValue, NULL, FALSE);

		// que_quan
		$this->que_quan->setDbValueDef($rsnew, $this->que_quan->CurrentValue, NULL, FALSE);

		// dia_chi_noi_o
		$this->dia_chi_noi_o->setDbValueDef($rsnew, $this->dia_chi_noi_o->CurrentValue, NULL, FALSE);

		// cmnd
		$this->cmnd->setDbValueDef($rsnew, $this->cmnd->CurrentValue, NULL, FALSE);

		// noi_cap
		$this->noi_cap->setDbValueDef($rsnew, $this->noi_cap->CurrentValue, NULL, FALSE);

		// ngay_cap
		$this->ngay_cap->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_cap->CurrentValue, 0), NULL, FALSE);

		// bo_phan_id
		$this->bo_phan_id->setDbValueDef($rsnew, $this->bo_phan_id->CurrentValue, NULL, FALSE);

		// username
		$this->username->setDbValueDef($rsnew, $this->username->CurrentValue, "", FALSE);

		// password
		$this->password->setDbValueDef($rsnew, $this->password->CurrentValue, "", FALSE);

		// userlevel
		
		if ($Security->canAdmin()) { // System admin
			
			$this->_userlevel->setDbValueDef($rsnew, $this->_userlevel->CurrentValue, 0, FALSE);
			
		}
		

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['nhan_vien_id']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("nhan_vienlist.php"), "", $this->TableVar, TRUE);
		$pageId = "addopt";
		$Breadcrumb->add("addopt", $pageId, $url);
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
				case "x__userlevel":
					$conn = Conn("DB");
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
						case "x__userlevel":
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
} // End class
?>