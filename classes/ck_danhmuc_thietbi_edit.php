<?php
namespace PHPMaker2020\projectCoKhi;

/**
 * Page class
 */
class ck_danhmuc_thietbi_edit extends ck_danhmuc_thietbi
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5DCEF576-624A-4686-A415-DE69CC04A397}";

	// Table name
	public $TableName = 'ck_danhmuc_thietbi';

	// Page object name
	public $PageObjName = "ck_danhmuc_thietbi_edit";

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

		// Table object (ck_danhmuc_thietbi)
		if (!isset($GLOBALS["ck_danhmuc_thietbi"]) || get_class($GLOBALS["ck_danhmuc_thietbi"]) == PROJECT_NAMESPACE . "ck_danhmuc_thietbi") {
			$GLOBALS["ck_danhmuc_thietbi"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ck_danhmuc_thietbi"];
		}

		// Table object (ck_chungloai_thietbi)
		if (!isset($GLOBALS['ck_chungloai_thietbi']))
			$GLOBALS['ck_chungloai_thietbi'] = new ck_chungloai_thietbi();

		// Table object (nhan_vien)
		if (!isset($GLOBALS['nhan_vien']))
			$GLOBALS['nhan_vien'] = new nhan_vien();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ck_danhmuc_thietbi');

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
		global $ck_danhmuc_thietbi;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ck_danhmuc_thietbi);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "ck_danhmuc_thietbiview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
			$key .= @$ar['thiet_bi_id'];
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->thiet_bi_id->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("ck_danhmuc_thietbilist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->thiet_bi_id->setVisibility();
		$this->chung_loai_id->setVisibility();
		$this->ky_ma_hieu->setVisibility();
		$this->bo_phan->setVisibility();
		$this->namsx->setVisibility();
		$this->ghi_chu->setVisibility();
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
		$this->setupLookupOptions($this->chung_loai_id);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ck_danhmuc_thietbilist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("thiet_bi_id") !== NULL) {
				$this->thiet_bi_id->setQueryStringValue(Get("thiet_bi_id"));
				$this->thiet_bi_id->setOldValue($this->thiet_bi_id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->thiet_bi_id->setQueryStringValue(Key(0));
				$this->thiet_bi_id->setOldValue($this->thiet_bi_id->QueryStringValue);
			} elseif (Post("thiet_bi_id") !== NULL) {
				$this->thiet_bi_id->setFormValue(Post("thiet_bi_id"));
				$this->thiet_bi_id->setOldValue($this->thiet_bi_id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->thiet_bi_id->setQueryStringValue(Route(2));
				$this->thiet_bi_id->setOldValue($this->thiet_bi_id->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_thiet_bi_id")) {
					$this->thiet_bi_id->setFormValue($CurrentForm->getValue("x_thiet_bi_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("thiet_bi_id") !== NULL) {
					$this->thiet_bi_id->setQueryStringValue(Get("thiet_bi_id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->thiet_bi_id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->thiet_bi_id->CurrentValue = NULL;
				}
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("ck_danhmuc_thietbilist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "ck_danhmuc_thietbilist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'thiet_bi_id' first before field var 'x_thiet_bi_id'
		$val = $CurrentForm->hasValue("thiet_bi_id") ? $CurrentForm->getValue("thiet_bi_id") : $CurrentForm->getValue("x_thiet_bi_id");
		if (!$this->thiet_bi_id->IsDetailKey)
			$this->thiet_bi_id->setFormValue($val);

		// Check field name 'chung_loai_id' first before field var 'x_chung_loai_id'
		$val = $CurrentForm->hasValue("chung_loai_id") ? $CurrentForm->getValue("chung_loai_id") : $CurrentForm->getValue("x_chung_loai_id");
		if (!$this->chung_loai_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->chung_loai_id->Visible = FALSE; // Disable update for API request
			else
				$this->chung_loai_id->setFormValue($val);
		}

		// Check field name 'ky_ma_hieu' first before field var 'x_ky_ma_hieu'
		$val = $CurrentForm->hasValue("ky_ma_hieu") ? $CurrentForm->getValue("ky_ma_hieu") : $CurrentForm->getValue("x_ky_ma_hieu");
		if (!$this->ky_ma_hieu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ky_ma_hieu->Visible = FALSE; // Disable update for API request
			else
				$this->ky_ma_hieu->setFormValue($val);
		}

		// Check field name 'bo_phan' first before field var 'x_bo_phan'
		$val = $CurrentForm->hasValue("bo_phan") ? $CurrentForm->getValue("bo_phan") : $CurrentForm->getValue("x_bo_phan");
		if (!$this->bo_phan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bo_phan->Visible = FALSE; // Disable update for API request
			else
				$this->bo_phan->setFormValue($val);
		}

		// Check field name 'namsx' first before field var 'x_namsx'
		$val = $CurrentForm->hasValue("namsx") ? $CurrentForm->getValue("namsx") : $CurrentForm->getValue("x_namsx");
		if (!$this->namsx->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->namsx->Visible = FALSE; // Disable update for API request
			else
				$this->namsx->setFormValue($val);
		}

		// Check field name 'ghi_chu' first before field var 'x_ghi_chu'
		$val = $CurrentForm->hasValue("ghi_chu") ? $CurrentForm->getValue("ghi_chu") : $CurrentForm->getValue("x_ghi_chu");
		if (!$this->ghi_chu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ghi_chu->Visible = FALSE; // Disable update for API request
			else
				$this->ghi_chu->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->thiet_bi_id->CurrentValue = $this->thiet_bi_id->FormValue;
		$this->chung_loai_id->CurrentValue = $this->chung_loai_id->FormValue;
		$this->ky_ma_hieu->CurrentValue = $this->ky_ma_hieu->FormValue;
		$this->bo_phan->CurrentValue = $this->bo_phan->FormValue;
		$this->namsx->CurrentValue = $this->namsx->FormValue;
		$this->ghi_chu->CurrentValue = $this->ghi_chu->FormValue;
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
		$this->thiet_bi_id->setDbValue($row['thiet_bi_id']);
		$this->chung_loai_id->setDbValue($row['chung_loai_id']);
		if (array_key_exists('EV__chung_loai_id', $rs->fields)) {
			$this->chung_loai_id->VirtualValue = $rs->fields('EV__chung_loai_id'); // Set up virtual field value
		} else {
			$this->chung_loai_id->VirtualValue = ""; // Clear value
		}
		$this->ky_ma_hieu->setDbValue($row['ky_ma_hieu']);
		$this->bo_phan->setDbValue($row['bo_phan']);
		$this->namsx->setDbValue($row['namsx']);
		$this->ghi_chu->setDbValue($row['ghi_chu']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['thiet_bi_id'] = NULL;
		$row['chung_loai_id'] = NULL;
		$row['ky_ma_hieu'] = NULL;
		$row['bo_phan'] = NULL;
		$row['namsx'] = NULL;
		$row['ghi_chu'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("thiet_bi_id")) != "")
			$this->thiet_bi_id->OldValue = $this->getKey("thiet_bi_id"); // thiet_bi_id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// thiet_bi_id
		// chung_loai_id
		// ky_ma_hieu
		// bo_phan
		// namsx
		// ghi_chu

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
				$curVal = trim(strval($this->chung_loai_id->CurrentValue));
				if ($curVal != "")
					$this->chung_loai_id->ViewValue = $this->chung_loai_id->lookupCacheOption($curVal);
				else
					$this->chung_loai_id->ViewValue = $this->chung_loai_id->Lookup !== NULL && is_array($this->chung_loai_id->Lookup->Options) ? $curVal : NULL;
				if ($this->chung_loai_id->ViewValue !== NULL) { // Load from cache
					$this->chung_loai_id->EditValue = array_values($this->chung_loai_id->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`chungloai_id`" . SearchString("=", $this->chung_loai_id->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->chung_loai_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->chung_loai_id->EditValue = $arwrk;
				}
			}

			// ky_ma_hieu
			$this->ky_ma_hieu->EditAttrs["class"] = "form-control";
			$this->ky_ma_hieu->EditCustomAttributes = "";
			if (!$this->ky_ma_hieu->Raw)
				$this->ky_ma_hieu->CurrentValue = HtmlDecode($this->ky_ma_hieu->CurrentValue);
			$this->ky_ma_hieu->EditValue = HtmlEncode($this->ky_ma_hieu->CurrentValue);
			$this->ky_ma_hieu->PlaceHolder = RemoveHtml($this->ky_ma_hieu->caption());

			// bo_phan
			$this->bo_phan->EditAttrs["class"] = "form-control";
			$this->bo_phan->EditCustomAttributes = "";
			if (!$this->bo_phan->Raw)
				$this->bo_phan->CurrentValue = HtmlDecode($this->bo_phan->CurrentValue);
			$this->bo_phan->EditValue = HtmlEncode($this->bo_phan->CurrentValue);
			$this->bo_phan->PlaceHolder = RemoveHtml($this->bo_phan->caption());

			// namsx
			$this->namsx->EditAttrs["class"] = "form-control";
			$this->namsx->EditCustomAttributes = "";
			if (!$this->namsx->Raw)
				$this->namsx->CurrentValue = HtmlDecode($this->namsx->CurrentValue);
			$this->namsx->EditValue = HtmlEncode($this->namsx->CurrentValue);
			$this->namsx->PlaceHolder = RemoveHtml($this->namsx->caption());

			// ghi_chu
			$this->ghi_chu->EditAttrs["class"] = "form-control";
			$this->ghi_chu->EditCustomAttributes = "";
			$this->ghi_chu->EditValue = HtmlEncode($this->ghi_chu->CurrentValue);
			$this->ghi_chu->PlaceHolder = RemoveHtml($this->ghi_chu->caption());

			// Edit refer script
			// thiet_bi_id

			$this->thiet_bi_id->LinkCustomAttributes = "";
			$this->thiet_bi_id->HrefValue = "";

			// chung_loai_id
			$this->chung_loai_id->LinkCustomAttributes = "";
			$this->chung_loai_id->HrefValue = "";

			// ky_ma_hieu
			$this->ky_ma_hieu->LinkCustomAttributes = "";
			$this->ky_ma_hieu->HrefValue = "";

			// bo_phan
			$this->bo_phan->LinkCustomAttributes = "";
			$this->bo_phan->HrefValue = "";

			// namsx
			$this->namsx->LinkCustomAttributes = "";
			$this->namsx->HrefValue = "";

			// ghi_chu
			$this->ghi_chu->LinkCustomAttributes = "";
			$this->ghi_chu->HrefValue = "";
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
		if ($this->thiet_bi_id->Required) {
			if (!$this->thiet_bi_id->IsDetailKey && $this->thiet_bi_id->FormValue != NULL && $this->thiet_bi_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->thiet_bi_id->caption(), $this->thiet_bi_id->RequiredErrorMessage));
			}
		}
		if ($this->chung_loai_id->Required) {
			if (!$this->chung_loai_id->IsDetailKey && $this->chung_loai_id->FormValue != NULL && $this->chung_loai_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->chung_loai_id->caption(), $this->chung_loai_id->RequiredErrorMessage));
			}
		}
		if ($this->ky_ma_hieu->Required) {
			if (!$this->ky_ma_hieu->IsDetailKey && $this->ky_ma_hieu->FormValue != NULL && $this->ky_ma_hieu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ky_ma_hieu->caption(), $this->ky_ma_hieu->RequiredErrorMessage));
			}
		}
		if ($this->bo_phan->Required) {
			if (!$this->bo_phan->IsDetailKey && $this->bo_phan->FormValue != NULL && $this->bo_phan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bo_phan->caption(), $this->bo_phan->RequiredErrorMessage));
			}
		}
		if ($this->namsx->Required) {
			if (!$this->namsx->IsDetailKey && $this->namsx->FormValue != NULL && $this->namsx->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->namsx->caption(), $this->namsx->RequiredErrorMessage));
			}
		}
		if ($this->ghi_chu->Required) {
			if (!$this->ghi_chu->IsDetailKey && $this->ghi_chu->FormValue != NULL && $this->ghi_chu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ghi_chu->caption(), $this->ghi_chu->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("ck_view_nhatky_thietbi", $detailTblVar) && $GLOBALS["ck_view_nhatky_thietbi"]->DetailEdit) {
			if (!isset($GLOBALS["ck_view_nhatky_thietbi_grid"]))
				$GLOBALS["ck_view_nhatky_thietbi_grid"] = new ck_view_nhatky_thietbi_grid(); // Get detail page object
			$GLOBALS["ck_view_nhatky_thietbi_grid"]->validateGridForm();
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// chung_loai_id
			$this->chung_loai_id->setDbValueDef($rsnew, $this->chung_loai_id->CurrentValue, 0, $this->chung_loai_id->ReadOnly);

			// ky_ma_hieu
			$this->ky_ma_hieu->setDbValueDef($rsnew, $this->ky_ma_hieu->CurrentValue, "", $this->ky_ma_hieu->ReadOnly);

			// bo_phan
			$this->bo_phan->setDbValueDef($rsnew, $this->bo_phan->CurrentValue, NULL, $this->bo_phan->ReadOnly);

			// namsx
			$this->namsx->setDbValueDef($rsnew, $this->namsx->CurrentValue, NULL, $this->namsx->ReadOnly);

			// ghi_chu
			$this->ghi_chu->setDbValueDef($rsnew, $this->ghi_chu->CurrentValue, NULL, $this->ghi_chu->ReadOnly);

			// Check referential integrity for master table 'ck_chungloai_thietbi'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_ck_chungloai_thietbi();
			$keyValue = isset($rsnew['chung_loai_id']) ? $rsnew['chung_loai_id'] : $rsold['chung_loai_id'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@chungloai_id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["ck_chungloai_thietbi"]))
					$GLOBALS["ck_chungloai_thietbi"] = new ck_chungloai_thietbi();
				$rsmaster = $GLOBALS["ck_chungloai_thietbi"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "ck_chungloai_thietbi", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("ck_view_nhatky_thietbi", $detailTblVar) && $GLOBALS["ck_view_nhatky_thietbi"]->DetailEdit) {
						if (!isset($GLOBALS["ck_view_nhatky_thietbi_grid"]))
							$GLOBALS["ck_view_nhatky_thietbi_grid"] = new ck_view_nhatky_thietbi_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "ck_view_nhatky_thietbi"); // Load user level of detail table
						$editRow = $GLOBALS["ck_view_nhatky_thietbi_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "ck_chungloai_thietbi") {
				$validMaster = TRUE;
				if (($parm = Get("fk_chungloai_id", Get("chung_loai_id"))) !== NULL) {
					$GLOBALS["ck_chungloai_thietbi"]->chungloai_id->setQueryStringValue($parm);
					$this->chung_loai_id->setQueryStringValue($GLOBALS["ck_chungloai_thietbi"]->chungloai_id->QueryStringValue);
					$this->chung_loai_id->setSessionValue($this->chung_loai_id->QueryStringValue);
					if (!is_numeric($GLOBALS["ck_chungloai_thietbi"]->chungloai_id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "ck_chungloai_thietbi") {
				$validMaster = TRUE;
				if (($parm = Post("fk_chungloai_id", Post("chung_loai_id"))) !== NULL) {
					$GLOBALS["ck_chungloai_thietbi"]->chungloai_id->setFormValue($parm);
					$this->chung_loai_id->setFormValue($GLOBALS["ck_chungloai_thietbi"]->chungloai_id->FormValue);
					$this->chung_loai_id->setSessionValue($this->chung_loai_id->FormValue);
					if (!is_numeric($GLOBALS["ck_chungloai_thietbi"]->chungloai_id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "ck_chungloai_thietbi") {
				if ($this->chung_loai_id->CurrentValue == "")
					$this->chung_loai_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("ck_view_nhatky_thietbi", $detailTblVar)) {
				if (!isset($GLOBALS["ck_view_nhatky_thietbi_grid"]))
					$GLOBALS["ck_view_nhatky_thietbi_grid"] = new ck_view_nhatky_thietbi_grid();
				if ($GLOBALS["ck_view_nhatky_thietbi_grid"]->DetailEdit) {
					$GLOBALS["ck_view_nhatky_thietbi_grid"]->CurrentMode = "edit";
					$GLOBALS["ck_view_nhatky_thietbi_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["ck_view_nhatky_thietbi_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["ck_view_nhatky_thietbi_grid"]->setStartRecordNumber(1);
					$GLOBALS["ck_view_nhatky_thietbi_grid"]->thiet_bi_id->IsDetailKey = TRUE;
					$GLOBALS["ck_view_nhatky_thietbi_grid"]->thiet_bi_id->CurrentValue = $this->thiet_bi_id->CurrentValue;
					$GLOBALS["ck_view_nhatky_thietbi_grid"]->thiet_bi_id->setSessionValue($GLOBALS["ck_view_nhatky_thietbi_grid"]->thiet_bi_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ck_danhmuc_thietbilist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_chung_loai_id":
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
						case "x_chung_loai_id":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>